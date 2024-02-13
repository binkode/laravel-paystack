<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Bulk Charges API allows you create and manage
 * multiple recurring payments from your customers
 *
 */
class BulkCharge
{
  use Request;

  /**
   * Send an array of objects with authorization codes
   * and amount (in kobo if currency is NGN, pesewas, if currency is GHS,
   * and cents, if currency is ZAR )so we can process transactions as a batch.
   *
   * @return \Illuminate\Http\Response
   */
  static function initiate($params = [])
  {
    return self::post("/bulkcharge", $params);
  }

  /**
   * This lists all bulk charge batches created by the integration.
   * Statuses can be active, paused, or complete.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/bulkcharge", $params);
  }

  /**
   * This endpoint retrieves a specific batch code.
   * It also returns useful information on its progress
   * by way of the total_charges and pending_charges attributes.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($bulkcharge, $params = [])
  {
    return self::get("/bulkcharge/$bulkcharge", $params);
  }

  /**
   * This endpoint retrieves the charges associated with a specified batch code.
   * Pagination parameters are available.
   * You can also filter by status.
   * Charge statuses can be pending, success or failed.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetchChargesBatch($bulkcharge, $params = [])
  {
    return self::get("/bulkcharge/$bulkcharge/charges", $params);
  }

  /**
   * Use this endpoint to pause processing a batch
   *
   * @return \Illuminate\Http\Response
   */
  static function pauseChargesBatch($bulkcharge, $params = [])
  {
    return self::get("/bulkcharge/pause/$bulkcharge", $params);
  }

  /**
   * Use this endpoint to resume processing a batch
   *
   * @return \Illuminate\Http\Response
   */
  static function resumeChargesBatch($bulkcharge, $params = [])
  {
    return self::get("/bulkcharge/resume/$bulkcharge", $params);
  }
}
