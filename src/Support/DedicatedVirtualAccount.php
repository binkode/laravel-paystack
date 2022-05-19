<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Dedicated Virtual Account API
 * enables Nigerian merchants to
 * manage unique payment accounts of their customers.
 *
 */
class DedicatedVirtualAccount
{
  use Request;

  /**
   * Create a dedicated virtual account and assign to a customer
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/dedicated_account", $params);
  }

  /**
   * List dedicated virtual accounts available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/dedicated_account", $params);
  }

  /**
   * Get details of a dedicated virtual account on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($dedicated_account, $params = [])
  {
    return self::get("/dedicated_account/$dedicated_account", $params);
  }

  /**
   * Deactivate a dedicated virtual account on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function remove($dedicated_account, $params = [])
  {
    return self::delete("/dedicated_account/$dedicated_account", $params);
  }

  /**
   * Split a dedicated virtual account transaction with one or more accounts
   *
   * @return \Illuminate\Http\Response
   */
  static function split($params = [])
  {
    return self::post("/dedicated_account/split", $params);
  }

  /**
   * If you've previously set up split payment for transactions
   * on a dedicated virtual account, you can remove it with this endpoint
   *
   * @return \Illuminate\Http\Response
   */
  static function removeSplit($params = [])
  {
    return self::delete("/dedicated_account/split", $params);
  }

  /**
   * Get available bank providers for a dedicated virtual account
   *
   * @return \Illuminate\Http\Response
   */
  static function providers($params = [])
  {
    return self::get("/dedicated_account/available_providers", $params);
  }
}
