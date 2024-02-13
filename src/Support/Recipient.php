<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Transfer Recipients API allows you create
 * and manage beneficiaries that you send money to
 *
 */
class Recipient
{
  use Request;

  /**
   * Creates a new recipient. A duplicate account number
   * will lead to the retrieval of the existing record.
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/transferrecipient", $params);
  }

  /**
   * Create multiple transfer recipients in batches.
   * A duplicate account number will lead to the retrieval of the existing record.
   *
   * @return \Illuminate\Http\Response
   */
  static function bulkCreate($params = [])
  {
    return self::post("/transferrecipient", $params);
  }

  /**
   * List transfer recipients available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/transferrecipient", $params);
  }

  /**
   * Get details of a transfer recipients on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($recipient, $params = [])
  {
    return self::get("/transferrecipient/$recipient", $params);
  }

  /**
   * Update a transfer recipients details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($recipient, $params = [])
  {
    return self::put("/transferrecipient/$recipient", $params);
  }

  /**
   * Deletes a transfer recipient (sets the transfer recipient to inactive)
   *
   * @return \Illuminate\Http\Response
   */
  static function remove($recipient, $params = [])
  {
    return self::delete("/transferrecipient/$recipient", $params);
  }
}
