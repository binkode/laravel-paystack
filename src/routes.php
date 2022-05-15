<?php

use Illuminate\Support\Facades\Route;
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
    'hooks'                           => 'post,hook,hook',
    // transactions
    'transaction'                     => 'get,transaction,list',
    'transaction/initialize'          => 'post,transaction,initialize',
    'transaction/verify/{reference}'  => 'get,transaction,verify',
    'transaction/{transaction}'       => 'get,transaction,fetch',
    'transaction/charge_authorization' => 'post,transaction,charge_authorization',
    'transaction/check_authorization' => 'post,transaction,check_authorization',
    'transaction/timeline/{id_or_reference}' => 'get,transaction,viewTimeline',
    'transaction/totals'      => 'get,transaction,totals',
    'transaction/export'      => 'get,transaction,export',
    'transaction/partial_debit'       => 'post,transaction,partial_debit',
    // splits
    'split'       => 'post,split,create',
    'split'       => 'get,split,list',
    'split/{split}'    => 'get,split,fetch',
    'split/{split}'    => 'put,split,update',
    'split/{split}/subaccount/add'  => 'post,split,add',
    'split/{split}/subaccount/remove'  => 'post,split,remove',
    // subaccounts
    'subaccount'       => 'post,subaccount,create',
    'subaccount'       => 'get,subaccount,list',
    'subaccount/{subaccount}' => 'get,subaccount,fetch',
    'subaccount/{subaccount}' => 'put,subaccount,update',
  ];

  $controls = [
    'hook'            => HookController::class,
    'transaction'     => TransactionController::class,
    'subaccount'      => SubAccountController::class,
    'split'           => SplitController::class,
  ];

  collect($routes)->map(function ($route, $endpoint) use ($controls) {
    [$method, $control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});
