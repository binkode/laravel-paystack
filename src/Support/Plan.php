<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Plans API allows you create and manage installment payment
 * options on your integration
 *
 */
class Plan
{
  use Request;

  /**
   * Create a plan on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/plan", $params);
  }

  /**
   * List plans available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/plan", $params);
  }

  /**
   * Get details of a plan on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($plan, $params = [])
  {
    return self::get("/plan/$plan", $params);
  }

  /**
   * Update a plan details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($plan, $params = [])
  {
    return self::put("/plan/$plan", $params);
  }
}
