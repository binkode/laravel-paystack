<?php

use Illuminate\Support\Facades\Route;
use Myckhel\Paystack\Traits\PaystackConfig;
// use Myckhel\Paystack\Http\Controllers\HookController;

$middleware  = PaystackConfig::config('route.middleware');
$prefix      = PaystackConfig::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function () {
  $routes = [
    'hooks'                         => 'post,hook,hook',
  ];

  $controls = [
    'hook'    => HookController::class,
  ];

  collect($routes)->map(function ($route, $endpoint) use ($controls) {
    [$method, $control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});
