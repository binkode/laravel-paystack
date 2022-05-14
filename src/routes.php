<?php

use Illuminate\Support\Facades\Route;
use Myckhel\Paystack\Http\Controllers\TransactionController;
use Myckhel\Paystack\Traits\PaystackConfig;
use Myckhel\Paystack\Http\Controllers\HookController;

$middleware  = PaystackConfig::config('route.middleware');
$prefix      = PaystackConfig::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function () {
  $routes = [
    'hooks'                           => 'post,hook,hook',
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
  ];

  $controls = [
    'hook'            => HookController::class,
    'transaction'     => TransactionController::class,
  ];

  collect($routes)->map(function ($route, $endpoint) use ($controls) {
    [$method, $control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});
