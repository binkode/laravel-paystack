<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Support\VirtualTerminal;

class VirtualTerminalController extends Controller
{
  public function unassignDestination($virtual_terminal, $destination_id)
  {
    return VirtualTerminal::unassignDestination($virtual_terminal, $destination_id, request()->all());
  }

  function __call($method, $args)
  {
    return $args
      ? VirtualTerminal::$method($args[0], request()->all())
      : VirtualTerminal::$method(request()->all());
  }
}
