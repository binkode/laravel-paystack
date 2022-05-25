<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Charge;

class ChargeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Charge::$method($args[0], request()->all())
      : Charge::$method(request()->all());
  }
}
