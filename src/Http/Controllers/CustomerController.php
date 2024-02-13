<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Customer;

class CustomerController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Customer::$method($args[0], request()->all())
      : Customer::$method(request()->all());
  }
}
