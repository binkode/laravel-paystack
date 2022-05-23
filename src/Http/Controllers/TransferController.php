<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Transfer;

class TransferController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Transfer::$method($args[0], request()->all())
      : Transfer::$method(request()->all());
  }
}
