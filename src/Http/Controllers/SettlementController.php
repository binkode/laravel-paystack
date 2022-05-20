<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Settlement;

class SettlementController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Settlement::$method($args[0], request()->all())
      : Settlement::$method(request()->all());
  }
}
