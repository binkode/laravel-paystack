<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Products API allows you create and manage
 * inventories on your integration
 *
 */
class TransferControl
{
  use Request;

  /**
   * Fetch the available balance on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function balance($params = [])
  {
    return self::get("/balance", $params);
  }

  /**
   * Fetch all pay-ins and pay-outs that occured on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function balanceLedger($params = [])
  {
    return self::get("/balance/ledger", $params);
  }

  /**
   * Generates a new OTP and sends to customer in the event
   * they are having trouble receiving one.
   *
   * @return \Illuminate\Http\Response
   */
  static function resendTransfersOTP($params = [])
  {
    return self::post("/transfer/resend_otp", $params);
  }

  /**
   * This is used in the event that you want to be able
   * to complete transfers programmatically without use of OTPs.
   * No arguments required. You will get an OTP to complete the request.
   *
   * @return \Illuminate\Http\Response
   */
  static function disableTransfersOTP($params = [])
  {
    return self::post("/transfer/disable_otp", $params);
  }

  /**
   * Finalize the request to disable OTP on your transfers
   *
   * @return \Illuminate\Http\Response
   */
  static function finalizeDisableOTP($params = [])
  {
    return self::post("/transfer/disable_otp_finalize", $params);
  }

  /**
   * In the event that a customer wants to stop being able to
   * complete transfers programmatically,
   * this endpoint helps turn OTP requirement back on. No arguments required.
   *
   * @return \Illuminate\Http\Response
   */
  static function enableTransfersOTP($params = [])
  {
    return self::post("/transfer/enable_otp", $params);
  }
}
