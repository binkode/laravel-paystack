<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Recipient;

class RecipientController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Recipient::$method($args[0], request()->all())
      : Recipient::$method(request()->all());
  }
}
