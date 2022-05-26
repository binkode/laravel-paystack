<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Refund;

class RefundController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Refund::$method($args[0], request()->all())
      : Refund::$method(request()->all());
  }
}
