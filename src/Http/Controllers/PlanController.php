<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Plan;

class PlanController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Plan::$method($args[0], request()->all())
      : Plan::$method(request()->all());
  }
}
