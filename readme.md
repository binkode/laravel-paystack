# laravel-paystack
Use [Paystack](https://paystack.com) Apis in your laravel project.

> There are other libraries but this was created to solve the issues such as flexibility and ability to call paystack apis in laravel Job scope.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/myckhel/laravel-paystack.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/myckhel/laravel-paystack.svg?style=flat-square)](https://packagist.org/packages/myckhel/laravel-paystack)

## [Paystack Doc Link](https://paystack.com/docs)

## Install
`composer require myckhel/laravel-paystack`

## Setup
The package will automatically register a service provider.

You need to publish the configuration file:

```php artisan vendor:publish --provider="Myckhel\Paystack\PaystackServiceProvider"```

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
        "middleware"    => ['api'], // For injecting middleware to the package's routes
        "prefix"    => 'api', // For injecting middleware to the package's routes
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

### Apple Pay **TODO**
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

### Plans **TODO**
### Subscriptions **TODO**
### Products **TODO**
### Payment Pages **TODO**
### Invoices **TODO**
### Settlements **TODO**
### Transfer Recipients **TODO**
### Transfers **TODO**
### Transfers Control **TODO**
### Bulk Charges **TODO**
### Control Panel **TODO**
### Charge **TODO**
### Disputes **TODO**
### Refunds **TODO**
### Verification **TODO**
### Miscellaneous **TODO**
```php
```

### Using WebHook route
Laravel paystack provides you a predefined endpoint that listens to and validates incoming paystack's webhook events.
It emits `Myckhel\Paystack\Events\Hook` on every incoming hooks which could be listened to.

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
```
  POST            hooks ......................................................... Myckhel\Paystack\Http\Controllers\HookController@hook
  GET|HEAD        subaccount .............................................. Myckhel\Paystack\Http\Controllers\SubAccountController@list
  PUT             subaccount/{subaccount} ............................... Myckhel\Paystack\Http\Controllers\SubAccountController@update
  GET|HEAD        transaction ............................................ Myckhel\Paystack\Http\Controllers\TransactionController@list
  POST            transaction/charge_authorization ....... Myckhel\Paystack\Http\Controllers\TransactionController@charge_authorization
  POST            transaction/check_authorization ......... Myckhel\Paystack\Http\Controllers\TransactionController@check_authorization
  GET|HEAD        transaction/export ................................... Myckhel\Paystack\Http\Controllers\TransactionController@export
  POST            transaction/initialize ........................... Myckhel\Paystack\Http\Controllers\TransactionController@initialize
  POST            transaction/partial_debit ..................... Myckhel\Paystack\Http\Controllers\TransactionController@partial_debit
  GET|HEAD        transaction/timeline/{id_or_reference} ......... Myckhel\Paystack\Http\Controllers\TransactionController@viewTimeline
  GET|HEAD        transaction/totals ................................... Myckhel\Paystack\Http\Controllers\TransactionController@totals
  GET|HEAD        transaction/verify/{reference} ....................... Myckhel\Paystack\Http\Controllers\TransactionController@verify
  GET|HEAD        transaction/{transaction} ............................. Myckhel\Paystack\Http\Controllers\TransactionController@fetch
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
