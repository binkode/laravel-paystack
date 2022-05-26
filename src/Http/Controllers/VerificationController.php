<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Verification;

class VerificationController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Verification::$method($args[0], request()->all())
      : Verification::$method(request()->all());
  }
}
