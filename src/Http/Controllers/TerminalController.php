<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\Terminal;

class TerminalController extends Controller
{
  public function fetchEventStatus($terminal, $event)
  {
    return Terminal::fetchEventStatus($terminal, $event, request()->all());
  }

  function __call($method, $args)
  {
    return $args
      ? Terminal::$method($args[0], request()->all())
      : Terminal::$method(request()->all());
  }
}
