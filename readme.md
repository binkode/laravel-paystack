# Laravel Paystack

Laravel wrapper for the [Paystack API](https://paystack.com/docs/), built for direct use in controllers, services, and queued jobs.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/binkode/laravel-paystack.svg?style=flat-square)](https://packagist.org/packages/binkode/laravel-paystack)
[![Total Downloads](https://img.shields.io/packagist/dt/binkode/laravel-paystack.svg?style=flat-square)](https://packagist.org/packages/binkode/laravel-paystack)
[![Tests](https://img.shields.io/github/actions/workflow/status/binkode/laravel-paystack/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/binkode/laravel-paystack/actions/workflows/tests.yml)
[![License](https://img.shields.io/packagist/l/binkode/laravel-paystack.svg?style=flat-square)](LICENSE.md)
[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://packagist.org/packages/binkode/laravel-paystack)

## Features

- Covers a broad set of Paystack endpoints (transactions, customers, transfers, plans, subscriptions, disputes, refunds, and more).
- Optional built-in HTTP routes for quick API proxying from your Laravel app.
- Built-in webhook route with signature validation and event dispatching.
- Compatible with Laravel `10`, `11`, `12`, and `13`.

## Installation

```bash
composer require binkode/laravel-paystack
```

Laravel package auto-discovery will register the service provider and facade alias automatically.

## Configuration

Publish config:

```bash
php artisan vendor:publish --provider="Binkode\Paystack\PaystackServiceProvider"
```

Set your credentials in `.env`:

```bash
PAYSTACK_PUBLIC_KEY=pk_test_xxx
PAYSTACK_SECRET_KEY=sk_test_xxx
PAYSTACK_URL=https://api.paystack.co
PAYSTACK_MERCHANT_EMAIL=merchant@example.com
```

Default config (`config/paystack.php`):

```php
return [
    "public_key" => env("PAYSTACK_PUBLIC_KEY"),
    "secret_key" => env("PAYSTACK_SECRET_KEY"),
    "url" => env("PAYSTACK_URL", "https://api.paystack.co"),
    "merchant_email" => env("PAYSTACK_MERCHANT_EMAIL"),
    "route" => [
        "middleware" => ["paystack_route_disabled", "api"],
        "prefix" => "api",
        "hook_middleware" => ["validate_paystack_hook", "api"],
    ],
];
```

## Quick Usage

Call support classes directly:

```php
use Binkode\Paystack\Support\Transaction;
use Binkode\Paystack\Support\Customer;

$init = Transaction::initialize([
    "email" => "customer@example.com",
    "amount" => 500000, // amount in kobo
]);

$verify = Transaction::verify("reference_here");

$customer = Customer::create([
    "email" => "customer@example.com",
    "first_name" => "Jane",
    "last_name" => "Doe",
]);
```

## Developer Integration Scenarios

Here are common design patterns for using this package across different parts of a Laravel application.

### 1. Controllers (Checkout & Verification)

Controllers should initiate payments and handle callback verification. When an API call fails, the package automatically calls Laravel's `abort()`, throwing a `Symfony\Component\HttpKernel\Exception\HttpException` which is caught by Laravel's global exception handler.

```php
namespace App\Http\Controllers;

use App\Models\Order;
use Binkode\Paystack\Support\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Step 1: Initialize checkout and redirect to Paystack
     */
    public function checkout(Order $order)
    {
        // Paystack amount is in kobo (e.g. 5,000 NGN = 500000 kobo)
        $amountInKobo = $order->total_amount * 100;

        $response = Transaction::initialize([
            'email' => auth()->user()->email,
            'amount' => $amountInKobo,
            'reference' => 'ORD-' . $order->id . '-' . time(),
            'callback_url' => route('payment.callback'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        if (isset($response['status']) && $response['status'] === true) {
            // Save reference to the order
            $order->update([
                'payment_reference' => $response['data']['reference'],
                'status' => 'pending',
            ]);

            // Redirect user to the Paystack checkout page
            return redirect($response['data']['authorization_url']);
        }

        return back()->with('error', 'Unable to initialize transaction with Paystack.');
    }

    /**
     * Step 2: Handle user redirection back from Paystack (Callback)
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('dashboard')->with('error', 'No reference returned.');
        }

        $response = Transaction::verify($reference);

        if (isset($response['data']['status']) && $response['data']['status'] === 'success') {
            $order = Order::where('payment_reference', $reference)->firstOrFail();
            
            // Avoid double processing (idempotency check)
            if ($order->status !== 'completed') {
                $order->update(['status' => 'completed']);
                // Trigger any order success events / mailers here
            }

            return redirect()->route('orders.show', $order)->with('success', 'Payment successful!');
        }

        return redirect()->route('dashboard')->with('error', 'Payment verification failed.');
    }
}
```

### 2. Service Classes (Business Logic Isolation)

For larger applications, abstract Paystack calls into a service layer to keep controllers clean. This is especially useful for managing complex customer profiles, plans, or subscriptions.

```php
namespace App\Services;

use App\Models\User;
use Binkode\Paystack\Support\Customer;
use Binkode\Paystack\Support\Subscription;

class BillingService
{
    /**
     * Ensure a user has a Paystack customer account, then subscribe them to a plan.
     */
    public function subscribeUserToPlan(User $user, string $planCode): array
    {
        // 1. Ensure user has a Paystack customer code
        if (!$user->paystack_customer_code) {
            $customerRes = Customer::create([
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
            ]);

            if (isset($customerRes['data']['customer_code'])) {
                $user->update([
                    'paystack_customer_code' => $customerRes['data']['customer_code'],
                ]);
            }
        }

        // 2. Create the subscription on Paystack
        $subscriptionRes = Subscription::create([
            'customer' => $user->paystack_customer_code,
            'plan' => $planCode,
        ]);

        if (isset($subscriptionRes['status']) && $subscriptionRes['status'] === true) {
            $user->update([
                'subscription_code' => $subscriptionRes['data']['subscription_code'],
                'subscription_status' => 'active',
                'subscribed_at' => now(),
            ]);
        }

        return $subscriptionRes;
    }
}
```

### 3. Queued Jobs (Background Processing)

When interacting with the Paystack API inside queued jobs (e.g. processing bulk transfers or validating statuses in the background), network errors or rate limits (`429 Too Many Requests`) can occur. 

You should design your jobs to handle these failures gracefully and support retries:

```php
namespace App\Jobs;

use App\Models\TransferRequest;
use Binkode\Paystack\Support\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProcessPayoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 60;

    protected TransferRequest $payout;

    public function __construct(TransferRequest $payout)
    {
        $this->payout = $payout;
    }

    public function handle(): void
    {
        // Don't re-process completed payouts
        if ($this->payout->status === 'processed') {
            return;
        }

        try {
            $response = Transfer::initiate([
                'source' => 'balance',
                'amount' => $this->payout->amount * 100, // in kobo
                'recipient' => $this->payout->recipient_code,
                'reason' => "Payout for Request #{$this->payout->id}",
                'reference' => 'PAY-' . $this->payout->id . '-' . time(),
            ]);

            if (isset($response['status']) && $response['status'] === true) {
                $this->payout->update([
                    'transfer_code' => $response['data']['transfer_code'],
                    'status' => 'processing',
                ]);
            }
        } catch (HttpException $e) {
            // Log the API failure
            Log::error("Paystack API Payout Failure: " . $e->getMessage(), [
                'payout_id' => $this->payout->id,
                'status_code' => $e->getStatusCode()
            ]);

            // If it's a server error (5xx) or rate limit (429), retry the job
            if ($e->getStatusCode() >= 500 || $e->getStatusCode() === 429) {
                $this->release($this->backoff);
                return;
            }

            // For client errors (400, 401, 403, 404), fail the job as retries won't help
            $this->payout->update(['status' => 'failed', 'error_log' => $e->getMessage()]);
            $this->fail($e);
        }
    }
}
```

### 4. Error Handling

Because the package uses Laravel's HTTP client under the hood, any failed response (status codes `4xx` and `5xx`) automatically throws a `Symfony\Component\HttpKernel\Exception\HttpException` via `abort($res->status(), ...)`.

You can catch this in your application code for fine-grained error handling:

```php
use Binkode\Paystack\Support\Transaction;
use Symfony\Component\HttpKernel\Exception\HttpException;

try {
    $verify = Transaction::verify("non_existent_ref");
} catch (HttpException $e) {
    $statusCode = $e->getStatusCode(); // e.g. 404
    $errorMessage = $e->getMessage(); // Message returned from Paystack
    
    // Handle error accordingly
}
```

## Available Support Classes

- `ApplePay`
- `BulkCharge`
- `Charge`
- `ControlPanel`
- `Customer`
- `DedicatedVirtualAccount`
- `Dispute`
- `Invoice`
- `Miscellaneous`
- `Order`
- `Page`
- `Plan`
- `Product`
- `Recipient`
- `Refund`
- `Settlement`
- `Split`
- `SubAccount`
- `Subscription`
- `Terminal`
- `Transaction`
- `Transfer`
- `TransferControl`
- `Verification`
- `VirtualTerminal`

See class methods in `src/Support/*`.

## Built-In Routes

The package registers route definitions from `src/routes.php`. By default, API routes are disabled through the `paystack_route_disabled` middleware.

To enable built-in routes, remove `paystack_route_disabled` from `paystack.route.middleware` in `config/paystack.php`.

Default route prefix is `api`, so endpoints resolve like:

- `POST /api/transaction/initialize`
- `GET /api/transaction/verify/{reference}`
- `POST /api/customer`

## Webhooks

Webhook endpoint:

- `POST /api/hooks` (route is registered as `Route::any`, but Paystack should call it with `POST`)

Incoming webhook requests are validated by the `validate_paystack_hook` middleware using your `PAYSTACK_SECRET_KEY`.

Each valid incoming webhook dispatches the `Binkode\Paystack\Events\Hook` event.

Create a listener:

```bash
php artisan make:listener PaystackWebhookListener --event=Binkode\\Paystack\\Events\\Hook
```

Example listener:

```php
use Binkode\Paystack\Events\Hook;
use App\Models\Order;
use App\Models\TransferRequest;
use Illuminate\Support\Facades\Log;

class PaystackWebhookListener
{
    public function handle(Hook $event): void
    {
        $payload = $event->event;
        $eventType = $payload['event'] ?? null;
        $data = $payload['data'] ?? [];

        Log::info("Paystack webhook received: {$eventType}");

        switch ($eventType) {
            case 'charge.success':
                $reference = $data['reference'] ?? null;
                if ($reference) {
                    $order = Order::where('payment_reference', $reference)->first();
                    if ($order && $order->status !== 'completed') {
                        $order->update(['status' => 'completed']);
                    }
                }
                break;

            case 'transfer.success':
                $transferCode = $data['transfer_code'] ?? null;
                if ($transferCode) {
                    $payout = TransferRequest::where('transfer_code', $transferCode)->first();
                    if ($payout) {
                        $payout->update(['status' => 'processed']);
                    }
                }
                break;

            case 'transfer.failed':
            case 'transfer.reversed':
                $transferCode = $data['transfer_code'] ?? null;
                if ($transferCode) {
                    $payout = TransferRequest::where('transfer_code', $transferCode)->first();
                    if ($payout) {
                        $payout->update([
                            'status' => 'failed',
                            'error_log' => $data['reason'] ?? 'Transfer failed or was reversed.',
                        ]);
                    }
                }
                break;

            default:
                Log::warning("Unhandled Paystack event: {$eventType}");
                break;
        }
    }
}
```

## Testing

```bash
composer test
```

## Useful Links

- [Paystack API Docs](https://paystack.com/docs/)
- [Postman Collection](https://www.postman.com/myckhel/workspace/myckhel/collection/9558301-024596ae-713a-4890-b12b-6842195ef802?action=share&creator=9558301)
- [Package Demo App](https://github.com/binkode/paystack-demo)

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md).

## Security

If you discover any security-related issues, email `binkode1@hotmail.com` instead of opening a public issue.

## License

Released under the [MIT License](LICENSE.md).
