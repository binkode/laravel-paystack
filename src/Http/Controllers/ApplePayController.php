<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\ApplePay;

class ApplePayController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? ApplePay::$method($args[0], request()->all())
      : ApplePay::$method(request()->all());
  }
}
