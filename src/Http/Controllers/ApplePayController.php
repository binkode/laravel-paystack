<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\ApplePay;

class ApplePayController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? ApplePay::$method($args[0], request()->all())
      : ApplePay::$method(request()->all());
  }
}
