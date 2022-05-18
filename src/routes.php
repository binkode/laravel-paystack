<?php

use Illuminate\Support\Facades\Route;
use Myckhel\Paystack\Http\Controllers\CustomerController;
use Myckhel\Paystack\Http\Controllers\TransactionController;
use Myckhel\Paystack\Traits\PaystackConfig;
use Myckhel\Paystack\Http\Controllers\HookController;
use Myckhel\Paystack\Http\Controllers\SubAccountController;
use Myckhel\Paystack\Http\Controllers\SplitController;

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
  ];

  $controls = [
    'hook'            => HookController::class,
    'transaction'     => TransactionController::class,
    'subaccount'      => SubAccountController::class,
    'split'           => SplitController::class,
    'customer'        => CustomerController::class,
  ];

  collect($routes)->map(function ($route, $index) use ($controls) {
    [$method, $endpoint] = explode(',', $index);
    [$control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});
