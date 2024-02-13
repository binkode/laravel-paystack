<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Transfer;

class TransferController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Transfer::$method($args[0], request()->all())
      : Transfer::$method(request()->all());
  }
}
