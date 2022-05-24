<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\BulkCharge;

class BulkChargeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? BulkCharge::$method($args[0], request()->all())
      : BulkCharge::$method(request()->all());
  }
}
