<?php

namespace Myckhel\Paystack\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisabledRoute
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
    abort(403, "This Endpoint Is Disabled \n enable it by replacing the 'paystack_route_disabled' middleware from your config");
  }
}
