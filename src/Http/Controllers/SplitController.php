<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Split;

class SplitController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Split::$method($args[0], request()->all())
      : Split::$method(request()->all());
  }
}
