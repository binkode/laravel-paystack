<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Dispute;

class DisputeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Dispute::$method($args[0], request()->all())
      : Dispute::$method(request()->all());
  }
}
