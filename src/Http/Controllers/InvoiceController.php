<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Invoice;

class InvoiceController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Invoice::$method($args[0], request()->all())
      : Invoice::$method(request()->all());
  }
}
