<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Transaction Splits API enables merchants split the settlement
 * for a transaction across their payout account,
 * and one or more Subaccounts.
 *
 */
class SubAccount
{
  use Request;

  /**
   * Create a subacount on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/subaccount", $params);
  }

  /**
   * List subaccounts available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/subaccount", $params);
  }

  /**
   * Get details of a subaccount on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($subaccount, $params = [])
  {
    return self::get("/subaccount/$subaccount", $params);
  }

  /**
   * Update a subaccount details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($subaccount, $params = [])
  {
    return self::put("/subaccount/$subaccount", $params);
  }
}
