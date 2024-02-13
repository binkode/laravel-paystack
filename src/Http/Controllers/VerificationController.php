<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Verification;

class VerificationController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Verification::$method($args[0], request()->all())
      : Verification::$method(request()->all());
  }
}
