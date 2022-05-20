<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Subscriptions API allows you create and manage
 * recurring paymenton your integration
 *
 */
class Subscription
{
  use Request;

  /**
   * Create a subscription on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/subscription", $params);
  }

  /**
   * List subscriptions available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/subscription", $params);
  }

  /**
   * Get details of a subscription on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($subscription, $params = [])
  {
    return self::get("/subscription/$subscription", $params);
  }

  /**
   * Enable a subscription on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function enable($params = [])
  {
    return self::post("/subscription/enable", $params);
  }

  /**
   * Disable a subscription on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function disable($params = [])
  {
    return self::post("/subscription/disable", $params);
  }

  /**
   * Generate a link for updating the card on a subscription
   *
   * @return \Illuminate\Http\Response
   */
  static function link($code, $params = [])
  {
    return self::get("/subscription/$code/manage/link", $params);
  }

  /**
   * Get details of a subscription on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function sendUpdateSubscription($code, $params = [])
  {
    return self::post("/subscription/$code/manage/email", $params);
  }
}
