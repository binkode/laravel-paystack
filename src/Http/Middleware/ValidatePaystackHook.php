<?php

namespace Binkode\Paystack\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Binkode\Paystack\PaystackConfig;

class ValidatePaystackHook
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $signature = $request->header('x-paystack-signature');
    if (!$signature) {
      abort(403, 'Signature header not found');
    }

    $signingSecret = PaystackConfig::config('secret_key');

    if (empty($signingSecret)) {
      abort(403, 'Signing Secret Not Set');
    }

    $computedSignature = hash_hmac('sha512', $request->getContent(), $signingSecret);

    if (!hash_equals($signature, $computedSignature)) return abort(403, "Invalid Secret Signature");

    return $next($request);
  }
}
