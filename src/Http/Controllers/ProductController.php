<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Product;

class ProductController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Product::$method($args[0], request()->all())
      : Product::$method(request()->all());
  }
}
