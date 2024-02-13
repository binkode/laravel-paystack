<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Invoice;

class InvoiceController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Invoice::$method($args[0], request()->all())
      : Invoice::$method(request()->all());
  }
}
