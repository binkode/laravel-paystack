<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\TransferControl;

class TransferControlController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? TransferControl::$method($args[0], request()->all())
      : TransferControl::$method(request()->all());
  }
}
