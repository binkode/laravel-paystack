<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Refunds API allows you create and manage transaction refunds
 *
 */
class Refund
{
  use Request;

  /**
   * Initiate a refund on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/refund", $params);
  }

  /**
   * List refunds available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/refund", $params);
  }

  /**
   * Get details of a refund on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($refund, $params = [])
  {
    return self::get("/refund/$refund", $params);
  }
}
