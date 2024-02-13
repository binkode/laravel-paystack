<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\ControlPanel;

class ControlPanelController extends Controller
{
  function __call($method, $args)
  {
    return $args
      ? ControlPanel::$method($args[0], request()->all())
      : ControlPanel::$method(request()->all());
  }
}
