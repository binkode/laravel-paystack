<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Charge;

class ChargeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Charge::$method($args[0], request()->all())
      : Charge::$method(request()->all());
  }
}
