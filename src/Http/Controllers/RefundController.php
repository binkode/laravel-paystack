<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Refund;

class RefundController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Refund::$method($args[0], request()->all())
      : Refund::$method(request()->all());
  }
}
