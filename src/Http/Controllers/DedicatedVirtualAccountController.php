<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\DedicatedVirtualAccount;

class DedicatedVirtualAccountController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? DedicatedVirtualAccount::$method($args[0], request()->all())
      : DedicatedVirtualAccount::$method(request()->all());
  }
}
