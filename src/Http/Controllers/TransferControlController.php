<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\TransferControl;

class TransferControlController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? TransferControl::$method($args[0], request()->all())
      : TransferControl::$method(request()->all());
  }
}
