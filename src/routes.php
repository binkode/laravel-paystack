<?php

use Illuminate\Support\Facades\Route;
use Myckhel\Paystack\Http\Controllers\ApplePayController;
use Myckhel\Paystack\Http\Controllers\CustomerController;
use Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController;
use Myckhel\Paystack\Http\Controllers\TransactionController;
use Myckhel\Paystack\Traits\PaystackConfig;
use Myckhel\Paystack\Http\Controllers\HookController;
use Myckhel\Paystack\Http\Controllers\PlanController;
use Myckhel\Paystack\Http\Controllers\ProductController;
use Myckhel\Paystack\Http\Controllers\SubAccountController;
use Myckhel\Paystack\Http\Controllers\SplitController;
use Myckhel\Paystack\Http\Controllers\SubscriptionController;

$middleware  = PaystackConfig::config('route.middleware');
$prefix      = PaystackConfig::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function () {
  $routes = [
    // hooks
    'post,hooks'                            => 'hook,hook',
    // transactions
    'get,transaction'                       => 'transaction,list',
    'post,transaction/initialize'           => 'transaction,initialize',
    'get,transaction/verify/{reference}'    => 'transaction,verify',
    'get,transaction/{transaction}'         => 'transaction,fetch',
    'post,transaction/charge_authorization' => 'transaction,charge_authorization',
    'post,transaction/check_authorization'  => 'transaction,check_authorization',
    'get,transaction/timeline/{id_or_reference}' => 'transaction,viewTimeline',
    'get,transaction/totals'      => 'transaction,totals',
    'get,transaction/export'      => 'transaction,export',
    'post,transaction/partial_debit'        => 'transaction,partial_debit',
    // splits
    'post,split'        => 'split,create',
    'get,split'         => 'split,list',
    'get,split/{split}' => 'split,fetch',
    'put,split/{split}' => 'split,update',
    'post,split/{split}/subaccount/add'     => 'split,add',
    'post,split/{split}/subaccount/remove'  => 'split,remove',
    // subaccounts
    'post,subaccount'       => 'subaccount,create',
    'get,subaccount'        => 'subaccount,list',
    'get,subaccount/{subaccount}' => 'subaccount,fetch',
    'put,subaccount/{subaccount}' => 'subaccount,update',
    // customers
    'post,customer'       => 'customer,create',
    'get,customer'        => 'customer,list',
    'get,customer/{customer}' => 'customer,fetch',
    'put,customer/{customer}' => 'customer,update',
    'post,customer/{customer}/identification' => 'customer,identification',
    'post,customer/set_risk_action' => 'customer,set_risk_action',
    'post,customer/deactivate_authorization' => 'customer,deactivate_authorization',
    // DedicatedVirtualAccount (dva)
    'post,dedicated_account'      => 'dva,create',
    'get,dedicated_account'       => 'dva,list',
    'get,dedicated_account/{dedicated_account}'       => 'dva,fetch',
    'delete,dedicated_account/{dedicated_account}'    => 'dva,remove',
    'post,dedicated_account/split'    => 'dva,split',
    'delete,dedicated_account/split'  => 'dva,removeSplit',
    'get,dedicated_account/available_providers'  => 'dva,providers',
    // apple pay
    'post,apple-pay/domain'     => 'apple,createDomain',
    'get,apple-pay/domain'      => 'apple,listDomains',
    'delete,apple-pay/domain'   => 'apple,removeDomain',
    // plans
    'post,plan'                 => 'plan,create',
    'get,plan'                  => 'plan,list',
    'get,plan/{plan}'           => 'plan,fetch',
    'put,plan/{plan}'           => 'plan,update',
    // subscriptions
    'post,subscription'                 => 'subscription,create',
    'get,subscription'                  => 'subscription,list',
    'get,subscription/{subscription}'   => 'subscription,fetch',
    'post,subscription/enable'          => 'subscription,enable',
    'post,subscription/disable'         => 'subscription,disable',
    'get,subscription/{code}/manage/link'  => 'subscription,link',
    'post,subscription/{code}/manage/email' => 'subscription,sendUpdateSubscription',
    // products
    'post,product'                 => 'product,create',
    'get,product'                  => 'product,list',
    'get,product/{product}'        => 'product,fetch',
    'put,product/{product}'        => 'product,update',
  ];

  $controls = [
    'hook'            => HookController::class,
    'transaction'     => TransactionController::class,
    'subaccount'      => SubAccountController::class,
    'split'           => SplitController::class,
    'customer'        => CustomerController::class,
    'dva'             => DedicatedVirtualAccountController::class,
    'apple'           => ApplePayController::class,
    'plan'            => PlanController::class,
    'subscription'    => SubscriptionController::class,
    'product'         => ProductController::class,
  ];

  collect($routes)->map(function ($route, $index) use ($controls) {
    [$method, $endpoint] = explode(',', $index);
    [$control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});
