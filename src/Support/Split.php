<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Transaction Splits API enables merchants split the settlement
 * for a transaction across their payout account,
 * and one or more Subaccounts.
 *
 */
class Split
{
  use Request;

  /**
   * Create a split payment on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/split", $params);
  }

  /**
   * List/search for the transaction splits available on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/split", $params);
  }

  /**
   * Get details of a split on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($split, $params = [])
  {
    return self::get("/split/$split", $params);
  }

  /**
   * Update a transaction split details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($split, $params = [])
  {
    return self::put("/split/$split", $params);
  }

  /**
   * Add a Subaccount to a Transaction Split, or update the share of an existing Subaccount in a Transaction Split
   *
   * @return \Illuminate\Http\Response
   */
  static function add($split, $params = [])
  {
    return self::post("/split/$split/subaccount/add", $params);
  }

  /**
   * Remove a subaccount from a transaction split
   *
   * @return \Illuminate\Http\Response
   */
  static function remove($split, $params = [])
  {
    return self::post("/split/$split/subaccount/remove", $params);
  }
}
