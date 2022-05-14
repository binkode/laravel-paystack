<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Transaction;

class TransactionController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Transaction::$method($args[0], request()->all())
      : Transaction::$method(request()->all());
  }
}
