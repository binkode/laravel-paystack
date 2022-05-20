<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Subscription;

class SubscriptionController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Subscription::$method($args[0], request()->all())
      : Subscription::$method(request()->all());
  }
}
