<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\SubAccount;

class SubAccountController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? SubAccount::$method($args[0], request()->all())
      : SubAccount::$method(request()->all());
  }
}
