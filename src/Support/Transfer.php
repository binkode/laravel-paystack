<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Transfers API allows you automate sending money on your integration
 *
 */
class Transfer
{
  use Request;

  /**
   * Status of transfer object returned will be pending
   * if OTP is disabled. In the event that an OTP is required,
   * status will read otp.
   *
   * @return \Illuminate\Http\Response
   */
  static function initiate($params = [])
  {
    return self::post("/transfer", $params);
  }

  /**
   * Finalize an initiated transfer
   *
   * @return \Illuminate\Http\Response
   */
  static function finalize($params = [])
  {
    return self::post("/transfer/finalize_transfer", $params);
  }

  /**
   * You need to disable the Transfers OTP requirement to use this endpoint.
   *
   * @return \Illuminate\Http\Response
   */
  static function bulkCreate($params = [])
  {
    return self::post("/transfer/bulk", $params);
  }

  /**
   * List the transfers made on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/transfer", $params);
  }

  /**
   * Get details of a transfer on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($transfer, $params = [])
  {
    return self::get("/transfer/$transfer", $params);
  }

  /**
   * Verify the status of a transfer on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function verify($reference, $params = [])
  {
    return self::get("/transfer/verify/$reference", $params);
  }
}
