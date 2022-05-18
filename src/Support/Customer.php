<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Customers API allows you create
 * and manage customers on your integration.
 *
 */
class Customer
{
  use Request;

  /**
   * Create a customer on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/customer", $params);
  }

  /**
   * List customers available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/customer", $params);
  }

  /**
   * Get details of a customer on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($customer, $params = [])
  {
    return self::get("/customer/$customer", $params);
  }

  /**
   * Update a customer's details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($customer, $params = [])
  {
    return self::put("/customer/$customer", $params);
  }

  /**
   * Validate a customer's identity
   *
   * @return \Illuminate\Http\Response
   */
  static function identification($customer, $params = [])
  {
    return self::post("/customer/$customer/identification", $params);
  }

  /**
   * Whitelist or blacklist a customer on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function set_risk_action($params = [])
  {
    return self::post("/customer/set_risk_action", $params);
  }

  /**
   * Deactivate an authorization when the card needs to be forgotten
   *
   * @return \Illuminate\Http\Response
   */
  static function deactivate_authorization($params = [])
  {
    return self::post("/customer/deactivate_authorization", $params);
  }
}
