<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Support\Page;

class PageController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? Page::$method($args[0], request()->all())
      : Page::$method(request()->all());
  }
}
