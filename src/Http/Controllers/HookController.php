<?php

namespace Myckhel\Paystack\Http\Controllers;

use Myckhel\Paystack\Events\Hook;
use Illuminate\Http\Request;
use Myckhel\Paystack\Traits\PaystackConfig;

class HookController extends Controller
{
  use PaystackConfig;

  public function hook(Request $request)
  {
    $signature = $request->header('x-paystack-signature');
    if (!$signature) {
      abort(403);
    }

    $signingSecret = $this->config('secret_key');

    if (empty($signingSecret)) {
      abort(403, 'Signing Secret Not Set');
    }

    $computedSignature = hash_hmac('sha512', $request->getContent(), $signingSecret);

    if (!hash_equals($signature, $computedSignature)) return abort(403);

    event(new Hook($request->all()));

    return ['status' => true];
  }
}
