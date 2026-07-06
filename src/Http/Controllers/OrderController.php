<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Order;

class OrderController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Order::$method($args[0], request()->all())
      : Order::$method(request()->all());
  }
}
