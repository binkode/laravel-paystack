<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Events\Hook;
use Illuminate\Http\Request;

class HookController extends Controller
{
  public function hook(Request $request)
  {
    event(new Hook($request->all()));

    return ['status' => true];
  }
}
