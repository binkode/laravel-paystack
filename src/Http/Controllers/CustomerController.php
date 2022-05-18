<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Customer;

class CustomerController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Customer::$method($args[0], request()->all())
      : Customer::$method(request()->all());
  }
}
