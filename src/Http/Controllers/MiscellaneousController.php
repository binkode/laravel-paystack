<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Miscellaneous;

class MiscellaneousController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Miscellaneous::$method($args[0], request()->all())
      : Miscellaneous::$method(request()->all());
  }
}
