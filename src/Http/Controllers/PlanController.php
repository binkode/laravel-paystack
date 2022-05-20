<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Plan;

class PlanController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Plan::$method($args[0], request()->all())
      : Plan::$method(request()->all());
  }
}
