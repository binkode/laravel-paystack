<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\BulkCharge;

class BulkChargeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? BulkCharge::$method($args[0], request()->all())
      : BulkCharge::$method(request()->all());
  }
}
