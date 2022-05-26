<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Dispute;

class DisputeController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Dispute::$method($args[0], request()->all())
      : Dispute::$method(request()->all());
  }
}
