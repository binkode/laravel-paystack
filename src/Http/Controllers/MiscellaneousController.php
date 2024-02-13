<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Miscellaneous;

class MiscellaneousController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Miscellaneous::$method($args[0], request()->all())
      : Miscellaneous::$method(request()->all());
  }
}
