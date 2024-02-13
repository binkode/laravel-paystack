<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Transaction;

class TransactionController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Transaction::$method($args[0], request()->all())
      : Transaction::$method(request()->all());
  }
}
