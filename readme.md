# laravel-paystack
Use [Paystack](https://paystack.com) Apis in your laravel project.

> There are other libraries but this was created to solve the issues such as flexibility and ability to call paystack apis in laravel Job scope.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/myckhel/laravel-paystack.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/myckhel/laravel-paystack.svg?style=flat-square)](https://packagist.org/packages/myckhel/laravel-paystack)
[![Postman Collection](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)](https://www.postman.com/myckhel/workspace/myckhel/collection/9558301-024596ae-713a-4890-b12b-6842195ef802?action=share&creator=9558301)
<table border="0">
  <tr>
    <td valign="top"><h2><a href="https://documenter.getpostman.com/view/9558301/Uz59PzqX#63ca3e0a-1018-40cd-a859-564dbc66c9e3">📚 APIs Documentation</a></h2></td>
    <td valign="top"><h2><a href="https://paystack.com/docs">📚 Paystack Doc</a></h2></td>
    <td valign="top"><h2><a href="https://github.com/myckhel/paystack-demo">🌐 Demo App</a></h2></td>
  </tr>
</table>

## Install
`composer require myckhel/laravel-paystack`

## Setup
The package will automatically register a service provider.

You need to publish the configuration file:

```php
php artisan vendor:publish --provider="Myckhel\Paystack\PaystackServiceProvider"
```

### Publish config
This is the default content of the config file ```paystack.php```:
```php
<?php

return [
    "public_key"    => env("PAYSTACK_PUBLIC_KEY"),
    "secret_key"    => env("PAYSTACK_SECRET_KEY"),
    "url"           => env("PAYSTACK_URL", 'https://api.paystack.co'),
    "merchant_email"           => env("PAYSTACK_MERCHANT_EMAIL"),

    "route" => [
        "middleware"        => ["paystack_route_disabled", "api"], // For injecting middleware to the package's routes
        "prefix"            => "api", // For injecting middleware to the package's routes
        "hook_middleware"   => ["validate_paystack_hook", "api"]
    ],
];
```

### Update env
Update Your Projects `.env` with their credentials:
```bash
PAYSTACK_PUBLIC_KEY=XXXXXXXXXXXXXXXXXXXX
PAYSTACK_SECRET_KEY=XXXXXXXXXXXXXXXXXXXX
PAYSTACK_URL=https://api.paystack.co
PAYSTACK_MERCHANT_EMAIL=username@email.extension
```

## Usage

### Transaction
```php
use Myckhel\Paystack\Support\Transaction;

Transaction::list($params);

Transaction::initialize($params);

Transaction::verify($reference, $params);

Transaction::fetch($transaction, $params);

Transaction::charge_authorization($params);

Transaction::check_authorization($params);

Transaction::viewTimeline($id_or_reference, $params);

Transaction::totals($params);

Transaction::export($params);

Transaction::partial_debit($params);
```

### Transaction Split
```php
use Myckhel\Paystack\Support\Split;

Split::create($params);

Split::list($params);

Split::fetch($split, $params);

Split::update($split, $params);

Split::add($split, $params);

Split::remove($split, $params);

```

### Apple Pay
```php
use Myckhel\Paystack\Support\ApplePay;

ApplePay::createDomain($params);

ApplePay::listDomains($params);

ApplePay::removeDomain($params);
```

### Subaccounts
```php
use Myckhel\Paystack\Support\SubAccount;

SubAccount::create($params);

SubAccount::list($params);

SubAccount::fetch($subaccount, $params);

SubAccount::update($subaccount, $params);
```

### Customer
```php
use Myckhel\Paystack\Support\Customer;

Customer::create($params);

Customer::list($params);

Customer::fetch($customer, $params);

Customer::update($customer, $params);

Customer::identification($customer, $params);

Customer::set_risk_action($customer, $params);

Customer::deactivate_authorization($params);
```

### Dedicated Virtual Accounts
```php
use Myckhel\Paystack\Support\DedicatedVirtualAccount;

DedicatedVirtualAccount::create($params);

DedicatedVirtualAccount::list($params);

DedicatedVirtualAccount::fetch($dedicated_account, $params);

DedicatedVirtualAccount::remove($dedicated_account, $params);

DedicatedVirtualAccount::split($params);

DedicatedVirtualAccount::removeSplit($params);

DedicatedVirtualAccount::providers($params);
```

### Plans
```php
use Myckhel\Paystack\Support\Plan;

Plan::create($params);

Plan::list($params);

Plan::fetch($plan, $params);

Plan::update($plan, $params);
```

### Subscriptions
```php
use Myckhel\Paystack\Support\Subscription;

Subscription::create($params);

Subscription::list($params);

Subscription::fetch($plan, $params);

Subscription::enable($params);

Subscription::disable($params);

Subscription::link($code, $params);

Subscription::sendUpdateSubscription($code, $params);
```

### Products
```php
use Myckhel\Paystack\Support\Product;

Product::create($params);

Product::list($params);

Product::fetch($product, $params);

Product::update($product, $params);
```

### Payment Pages
```php
use Myckhel\Paystack\Support\Page;

Page::create($params);

Page::list($params);

Page::fetch($page, $params);

Page::update($page, $params);

Page::checkSlug($slug, $params);

Page::addProduct($page, $params);
```

### Invoices
```php
use Myckhel\Paystack\Support\Invoice;

Invoice::create($params);

Invoice::list($params);

Invoice::fetch($invoice, $params);

Invoice::update($invoice, $params);

Invoice::verify($code, $params);

Invoice::notify($code, $params);

Invoice::totals($params);

Invoice::finalize($code, $params);

Invoice::archive($code, $params);
```

### Settlements
```php
use Myckhel\Paystack\Support\Settlement;

Settlement::list($params);

Settlement::transactions($settlement, $params);
```

### Transfer Recipients
```php
use Myckhel\Paystack\Support\Recipient;

Recipient::create($params);

Recipient::bulkCreate($params);

Recipient::list($params);

Recipient::fetch($recipient, $params);

Recipient::update($recipient, $params);

Recipient::remove($recipient, $params);
```

### Transfers
```php
use Myckhel\Paystack\Support\Transfer;

Transfer::initiate($params);

Transfer::finalize($params);

Transfer::bulkCreate($params);

Transfer::list($params);

Transfer::fetch($transfer, $params);

Transfer::fetch($reference, $params);
```

### Transfers Control
```php
use Myckhel\Paystack\Support\TransferControl;

TransferControl::balance($params);

TransferControl::balanceLedger($params);

TransferControl::resendTransfersOTP($params);

TransferControl::disableTransfersOTP($params);

TransferControl::finalizeDisableOTP($params);

TransferControl::enableTransfersOTP($params);
```

### Bulk Charges
```php
use Myckhel\Paystack\Support\BulkCharge;

BulkCharge::initiate($params);

BulkCharge::list($params);

BulkCharge::fetch($bulkcharge, $params);

BulkCharge::fetchChargesBatch($bulkcharge, $params);

BulkCharge::pauseChargesBatch($bulkcharge, $params);

BulkCharge::resumeChargesBatch($bulkcharge, $params);
```

### Control Panel
```php
use Myckhel\Paystack\Support\ControlPanel;

ControlPanel::fetchPaymentSessionTimeout($params);

ControlPanel::updatePaymentSessionTimeout($params);
```

### Charge
```php
use Myckhel\Paystack\Support\Charge;

Charge::create($params);

Charge::submitPin($params);

Charge::submitOtp($params);

Charge::submitPhone($params);

Charge::submitBirthday($params);

Charge::submitAddress($params);

Charge::checkPending($reference, $params);
```

### Disputes
```php
use Myckhel\Paystack\Support\Dispute;

Dispute::list($params);

Dispute::fetch($dispute, $params);

Dispute::listTransaction($dispute, $params);

Dispute::update($dispute, $params);

Dispute::addEvidence($dispute, $params);

Dispute::getUploadURL($dispute, $params);

Dispute::resolve($dispute, $params);

Dispute::export($params);
```

### Refunds
```php
use Myckhel\Paystack\Support\Refund;

Refund::create($params);

Refund::list($params);

Refund::fetch($refund, $params);
```

### Verification
```php
use Myckhel\Paystack\Support\Verification;

Verification::resolve($params);

Verification::validateAccount($params);

Verification::resolveCardBIN($bin, $params);
```

### Miscellaneous
```php
use Myckhel\Paystack\Support\Miscellaneous;

Miscellaneous::listBanks($params);

Miscellaneous::listProviders($params);

Miscellaneous::listCountries($params);

Miscellaneous::listStates($params);
```

### Using WebHook route
Laravel paystack provides you a predefined endpoint that listens to and validates incoming paystack's webhook events.
It emits `Myckhel\Paystack\Events\Hook` on every incoming hooks which could be listened to.
The hook request is validated with `validate_paystack_hook` middleware by using the paystack's config `secret_key` against the incoming request.

## Setup Paystack Webhook
[Check official page to read more about paystack webhook](https://paystack.com/docs/payments/webhooks/#introduction)
laravel-paystack exposes `hooks` api endpoint
use the enddpoints url to for the paystack webhook url during the setup.
```
| POST      | /hooks                                |               | Myckhel\Paystack\Http\Controllers\HookController@hook              | api            |
```

## Listening to laravel-paystack Hook event
You may start listening to incoming paystack webhooks after setup by registering the event in your laravel project's `EventServiceProvider` file.

- ### Create an event listener class
```bash
php artisan make:listener PaystackWebHookListener --event=Myckhel\Paystack\Events\Hook
```
- ### Handle paystack webhook events
```php
<?php

namespace App\Listeners;

use Myckhel\Paystack\Events\Hook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class PaystackWebHookListener
{
    /**
     * Handle the event.
     *
     * @param  Myckhel\Paystack\Events\Hook  $event
     * @return void
     */
    public function handle(Hook $event)
    {
        Log::debug($event->event);
        /* {
            "event":"charge.success",
            "data": {  
              "id":302961,
              "domain":"live",
              "status":"success",
              "reference":"qTPrJoy9Bx",
              "amount":10000,
              "message":null,
              "gateway_response":"Approved by Financial Institution",
              "paid_at":"2016-09-30T21:10:19.000Z",
              "created_at":"2016-09-30T21:09:56.000Z",
              "channel":"card",
              "currency":"NGN",
              "ip_address":"41.242.49.37",
              "metadata":0,
              "log":{  
                "time_spent":16,
                "attempts":1,
                "authentication":"pin",
                "errors":0,
                "success":false,
                "mobile":false,
                "input":[],
                "channel":null,
                "history":[  
                  {  
                    "type":"input",
                    "message":"Filled these fields: card number, card expiry, card cvv",
                    "time":15
                  },
                  {  
                    "type":"action",
                    "message":"Attempted to pay",
                    "time":15
                  },
                  {  
                    "type":"auth",
                    "message":"Authentication Required: pin",
                    "time":16
                  }
                ]
              },
              "fees":null,
              "customer":{  
                "id":68324,
                "first_name":"BoJack",
                "last_name":"Horseman",
                "email":"bojack@horseman.com",
                "customer_code":"CUS_qo38as2hpsgk2r0",
                "phone":null,
                "metadata":null,
                "risk_action":"default"
              },
              "authorization":{  
                "authorization_code":"AUTH_f5rnfq9p",
                "bin":"539999",
                "last4":"8877",
                "exp_month":"08",
                "exp_year":"2020",
                "card_type":"mastercard DEBIT",
                "bank":"Guaranty Trust Bank",
                "country_code":"NG",
                "brand":"mastercard",
                "account_name": "BoJack Horseman"
              },
              "plan":{}
            } 
          }
        */
    }
}
```
- ### Register `PaystackWebHookListener`
```php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Myckhel\Paystack\Events\Hook;
use App\Listeners\PaystackWebHookListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ...
        Hook::class => [
            PaystackWebHookListener::class,
        ],
    ];
```

### Using built in routes
> Enable the in built routes by removing `paystack_route_disabled` middleware from paystack's route config. 
```py
  POST            apple-pay/domain .............. Myckhel\Paystack\Http\Controllers\ApplePayController@createDomain
  GET|HEAD        apple-pay/domain ............... Myckhel\Paystack\Http\Controllers\ApplePayController@listDomains
  DELETE          apple-pay/domain .............. Myckhel\Paystack\Http\Controllers\ApplePayController@removeDomain
  GET|HEAD        balance ..................... Myckhel\Paystack\Http\Controllers\TransferControlController@balance
  GET|HEAD        balance/ledger ........ Myckhel\Paystack\Http\Controllers\TransferControlController@balanceLedger
  GET|HEAD        bank ........................ Myckhel\Paystack\Http\Controllers\MiscellaneousController@listBanks
  GET|HEAD        bank/resolve ................... Myckhel\Paystack\Http\Controllers\VerificationController@resolve
  POST            bank/validate .......... Myckhel\Paystack\Http\Controllers\VerificationController@validateAccount
  GET|HEAD        banks ................... Myckhel\Paystack\Http\Controllers\MiscellaneousController@listProviders
  POST            bulkcharge ...................... Myckhel\Paystack\Http\Controllers\BulkChargeController@initiate
  GET|HEAD        bulkcharge .......................... Myckhel\Paystack\Http\Controllers\BulkChargeController@list
  GET|HEAD        bulkcharge/pause/{bulkcharge} Myckhel\Paystack\Http\Controllers\BulkChargeController@pauseCharge…
  GET|HEAD        bulkcharge/resume/{bulkcharge} Myckhel\Paystack\Http\Controllers\BulkChargeController@resumeChar…
  GET|HEAD        bulkcharge/{bulkcharge} ............ Myckhel\Paystack\Http\Controllers\BulkChargeController@fetch
  GET|HEAD        bulkcharge/{bulkcharge}/charges Myckhel\Paystack\Http\Controllers\BulkChargeController@fetchChar…
  POST            charge ................................ Myckhel\Paystack\Http\Controllers\ChargeController@create
  POST            charge/submit_address .......... Myckhel\Paystack\Http\Controllers\ChargeController@submitAddress
  POST            charge/submit_birthday ........ Myckhel\Paystack\Http\Controllers\ChargeController@submitBirthday
  POST            charge/submit_otp .................. Myckhel\Paystack\Http\Controllers\ChargeController@submitOtp
  POST            charge/submit_phone .............. Myckhel\Paystack\Http\Controllers\ChargeController@submitPhone
  POST            charge/submit_pin .................. Myckhel\Paystack\Http\Controllers\ChargeController@submitPin
  GET|HEAD        charge/{reference} .............. Myckhel\Paystack\Http\Controllers\ChargeController@checkPending
  GET|HEAD        country ................. Myckhel\Paystack\Http\Controllers\MiscellaneousController@listCountries
  POST            customer ............................ Myckhel\Paystack\Http\Controllers\CustomerController@create
  GET|HEAD        customer .............................. Myckhel\Paystack\Http\Controllers\CustomerController@list
  POST            customer/deactivate_authorization Myckhel\Paystack\Http\Controllers\CustomerController@deactivat…
  POST            customer/set_risk_action ... Myckhel\Paystack\Http\Controllers\CustomerController@set_risk_action
  GET|HEAD        customer/{customer} .................. Myckhel\Paystack\Http\Controllers\CustomerController@fetch
  PUT             customer/{customer} ................. Myckhel\Paystack\Http\Controllers\CustomerController@update
  POST            customer/{customer}/identification Myckhel\Paystack\Http\Controllers\CustomerController@identifi…
  GET|HEAD        decision/bin/{bin} ...... Myckhel\Paystack\Http\Controllers\VerificationController@resolveCardBIN
  POST            dedicated_account .... Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController@create
  GET|HEAD        dedicated_account ...... Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController@list
  GET|HEAD        dedicated_account/available_providers Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountC…
  POST            dedicated_account/split Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController@split
  DELETE          dedicated_account/split Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController@remo…
  GET|HEAD        dedicated_account/{dedicated_account} Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountC…
  DELETE          dedicated_account/{dedicated_account} Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountC…
  GET|HEAD        dispute ................................ Myckhel\Paystack\Http\Controllers\DisputeController@list
  GET|HEAD        dispute/transaction/{dispute} Myckhel\Paystack\Http\Controllers\DisputeController@listTransaction
  GET|HEAD        dispute/{dispute} ..................... Myckhel\Paystack\Http\Controllers\DisputeController@fetch
  PUT             dispute/{dispute} .................... Myckhel\Paystack\Http\Controllers\DisputeController@update
  POST            dispute/{dispute}/evidence ...... Myckhel\Paystack\Http\Controllers\DisputeController@addEvidence
  GET|HEAD        dispute/{dispute}/export ............. Myckhel\Paystack\Http\Controllers\DisputeController@export
  PUT             dispute/{dispute}/resolve ........... Myckhel\Paystack\Http\Controllers\DisputeController@resolve
  GET|HEAD        dispute/{dispute}/upload_url ... Myckhel\Paystack\Http\Controllers\DisputeController@getUploadURL
  POST            hooks ..................................... Myckhel\Paystack\Http\Controllers\HookController@hook
  GET|HEAD        integration/payment_session_timeout Myckhel\Paystack\Http\Controllers\ControlPanelController@fet…
  PUT             integration/payment_session_timeout Myckhel\Paystack\Http\Controllers\ControlPanelController@upd…
  POST            page .................................... Myckhel\Paystack\Http\Controllers\PageController@create
  GET|HEAD        page ...................................... Myckhel\Paystack\Http\Controllers\PageController@list
  GET|HEAD        page/check_slug_availability/{slug} .. Myckhel\Paystack\Http\Controllers\PageController@checkSlug
  GET|HEAD        page/{page} .............................. Myckhel\Paystack\Http\Controllers\PageController@fetch
  PUT             page/{page} ............................. Myckhel\Paystack\Http\Controllers\PageController@update
  POST            page/{page}/product ................. Myckhel\Paystack\Http\Controllers\PageController@addProduct
  POST            paymentrequest ....................... Myckhel\Paystack\Http\Controllers\InvoiceController@create
  GET|HEAD        paymentrequest ......................... Myckhel\Paystack\Http\Controllers\InvoiceController@list
  POST            paymentrequest/archive/{invoice_code} Myckhel\Paystack\Http\Controllers\InvoiceController@archive
  POST            paymentrequest/finalize/{invoice_code} Myckhel\Paystack\Http\Controllers\InvoiceController@final…
  POST            paymentrequest/notify/{invoice_code} . Myckhel\Paystack\Http\Controllers\InvoiceController@notify
  GET|HEAD        paymentrequest/totals ................ Myckhel\Paystack\Http\Controllers\InvoiceController@totals
  GET|HEAD        paymentrequest/verify/{invoice_code} . Myckhel\Paystack\Http\Controllers\InvoiceController@verify
  GET|HEAD        paymentrequest/{invoice} .............. Myckhel\Paystack\Http\Controllers\InvoiceController@fetch
  PUT             paymentrequest/{invoice} ............. Myckhel\Paystack\Http\Controllers\InvoiceController@update
  POST            plan .................................... Myckhel\Paystack\Http\Controllers\PlanController@create
  GET|HEAD        plan ...................................... Myckhel\Paystack\Http\Controllers\PlanController@list
  GET|HEAD        plan/{plan} .............................. Myckhel\Paystack\Http\Controllers\PlanController@fetch
  PUT             plan/{plan} ............................. Myckhel\Paystack\Http\Controllers\PlanController@update
  POST            product .............................. Myckhel\Paystack\Http\Controllers\ProductController@create
  GET|HEAD        product ................................ Myckhel\Paystack\Http\Controllers\ProductController@list
  GET|HEAD        product/{product} ..................... Myckhel\Paystack\Http\Controllers\ProductController@fetch
  PUT             product/{product} .................... Myckhel\Paystack\Http\Controllers\ProductController@update
  POST            refund ................................ Myckhel\Paystack\Http\Controllers\RefundController@create
  GET|HEAD        refund .................................. Myckhel\Paystack\Http\Controllers\RefundController@list
  GET|HEAD        refund/{refund} ........................ Myckhel\Paystack\Http\Controllers\RefundController@fetch
  GET|HEAD        settlement .......................... Myckhel\Paystack\Http\Controllers\SettlementController@list
  GET|HEAD        settlement/{settlement}/transactions Myckhel\Paystack\Http\Controllers\SettlementController@tran…
  POST            split .................................. Myckhel\Paystack\Http\Controllers\SplitController@create
  GET|HEAD        split .................................... Myckhel\Paystack\Http\Controllers\SplitController@list
  GET|HEAD        split/{split} ........................... Myckhel\Paystack\Http\Controllers\SplitController@fetch
  PUT             split/{split} .......................... Myckhel\Paystack\Http\Controllers\SplitController@update
  POST            split/{split}/subaccount/add .............. Myckhel\Paystack\Http\Controllers\SplitController@add
  POST            split/{split}/subaccount/remove ........ Myckhel\Paystack\Http\Controllers\SplitController@remove
  POST            subaccount ........................ Myckhel\Paystack\Http\Controllers\SubAccountController@create
  GET|HEAD        subaccount .......................... Myckhel\Paystack\Http\Controllers\SubAccountController@list
  GET|HEAD        subaccount/{subaccount} ............ Myckhel\Paystack\Http\Controllers\SubAccountController@fetch
  PUT             subaccount/{subaccount} ........... Myckhel\Paystack\Http\Controllers\SubAccountController@update
  POST            subscription .................... Myckhel\Paystack\Http\Controllers\SubscriptionController@create
  GET|HEAD        subscription ...................... Myckhel\Paystack\Http\Controllers\SubscriptionController@list
  POST            subscription/disable ........... Myckhel\Paystack\Http\Controllers\SubscriptionController@disable
  POST            subscription/enable ............. Myckhel\Paystack\Http\Controllers\SubscriptionController@enable
  POST            subscription/{code}/manage/email Myckhel\Paystack\Http\Controllers\SubscriptionController@sendUp…
  GET|HEAD        subscription/{code}/manage/link ... Myckhel\Paystack\Http\Controllers\SubscriptionController@link
  GET|HEAD        subscription/{subscription} ...... Myckhel\Paystack\Http\Controllers\SubscriptionController@fetch
  GET|HEAD        transaction ........................ Myckhel\Paystack\Http\Controllers\TransactionController@list
  POST            transaction/charge_authorization Myckhel\Paystack\Http\Controllers\TransactionController@charge_…
  POST            transaction/check_authorization Myckhel\Paystack\Http\Controllers\TransactionController@check_au…
  GET|HEAD        transaction/export ............... Myckhel\Paystack\Http\Controllers\TransactionController@export
  POST            transaction/initialize ....... Myckhel\Paystack\Http\Controllers\TransactionController@initialize
  POST            transaction/partial_debit . Myckhel\Paystack\Http\Controllers\TransactionController@partial_debit
  GET|HEAD        transaction/timeline/{id_or_reference} Myckhel\Paystack\Http\Controllers\TransactionController@v…
  GET|HEAD        transaction/totals ............... Myckhel\Paystack\Http\Controllers\TransactionController@totals
  GET|HEAD        transaction/verify/{reference} ... Myckhel\Paystack\Http\Controllers\TransactionController@verify
  GET|HEAD        transaction/{transaction} ......... Myckhel\Paystack\Http\Controllers\TransactionController@fetch
  POST            transfer .......................... Myckhel\Paystack\Http\Controllers\TransferController@initiate
  GET|HEAD        transfer .............................. Myckhel\Paystack\Http\Controllers\TransferController@list
  POST            transfer/bulk ................... Myckhel\Paystack\Http\Controllers\TransferController@bulkCreate
  POST            transfer/disable_otp Myckhel\Paystack\Http\Controllers\TransferControlController@disableTransfer…
  POST            transfer/disable_otp_finalize Myckhel\Paystack\Http\Controllers\TransferControlController@finali…
  POST            transfer/enable_otp Myckhel\Paystack\Http\Controllers\TransferControlController@enableTransfersO…
  POST            transfer/finalize_transfer ........ Myckhel\Paystack\Http\Controllers\TransferController@finalize
  POST            transfer/resend_otp Myckhel\Paystack\Http\Controllers\TransferControlController@resendTransfersO…
  GET|HEAD        transfer/verify/{reference} ......... Myckhel\Paystack\Http\Controllers\TransferController@verify
  GET|HEAD        transfer/{transfer} .................. Myckhel\Paystack\Http\Controllers\TransferController@fetch
  POST            transferrecipient .................. Myckhel\Paystack\Http\Controllers\RecipientController@create
  GET|HEAD        transferrecipient .................... Myckhel\Paystack\Http\Controllers\RecipientController@list
  POST            transferrecipient/bulk ......... Myckhel\Paystack\Http\Controllers\RecipientController@bulkCreate
  GET|HEAD        transferrecipient/{transferrecipient} Myckhel\Paystack\Http\Controllers\RecipientController@fetch
  PUT             transferrecipient/{transferrecipient} Myckhel\Paystack\Http\Controllers\RecipientController@upda…
  DELETE          transferrecipient/{transferrecipient} Myckhel\Paystack\Http\Controllers\RecipientController@remo…
```

<!-- 
## Testing
Run the tests with:

``` bash
vendor/bin/phpunit
```
 -->
## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [myckhel](https://github.com/myckhel)
- [All Contributors](https://github.com/myckhel/laravel-paystack/contributors)

## Security
If you discover any security-related issues, please email myckhel1@hotmail.com instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
