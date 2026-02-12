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
- Compatible with Laravel `10`, `11`, and `12`.

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
- `Page`
- `Plan`
- `Product`
- `Recipient`
- `Refund`
- `Settlement`
- `Split`
- `SubAccount`
- `Subscription`
- `Transaction`
- `Transfer`
- `TransferControl`
- `Verification`

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
use Illuminate\Support\Facades\Log;

class PaystackWebhookListener
{
    public function handle(Hook $event): void
    {
        Log::info("Paystack webhook received", [
            "event" => $event->event["event"] ?? null,
            "payload" => $event->event,
        ]);
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
