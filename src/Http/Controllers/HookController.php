<?php

namespace Binkode\Paystack\Http\Controllers;

use Binkode\Paystack\Events\Hook;
use Illuminate\Http\Request;

class HookController extends Controller
{
  public function hook(Request $request)
  {
    event(new Hook($request->all()));

    return ['status' => true];
  }
}
