<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Apple Pay API allows you register your application's
 * top-level domain or subdomain
 *
 */
class ApplePay
{
  use Request;

  /**
   * Register a top-level domain or subdomain for your Apple Pay integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function createDomain($params = [])
  {
    return self::post("/apple-pay/domain", $params);
  }

  /**
   * Lists all registered domains on your integration.
   * Returns an empty array if no domains have been added.
   *
   * @return \Illuminate\Http\Response
   */
  static function listDomains($params = [])
  {
    return self::get("/apple-pay/domain", $params);
  }

  /**
   * Unregister a top-level domain or subdomain previously used
   * for your Apple Pay integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function removeDomain($params = [])
  {
    return self::delete("/apple-pay/domain", $params);
  }
}
