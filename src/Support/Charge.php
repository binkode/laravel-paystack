<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Charge API allows you to configure payment channel of your choice when initiating a payment.
 *
 */
class Charge
{
  use Request;

  /**
   * Initiate a payment by integrating the payment channel of your choice.
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/charge", $params);
  }

  /**
   * Submit PIN to continue a charge
   *
   * @return \Illuminate\Http\Response
   */
  static function submitPin($params = [])
  {
    return self::post("/charge/submit_pin", $params);
  }

  /**
   * Submit OTP to complete a charge
   *
   * @return \Illuminate\Http\Response
   */
  static function submitOtp($params = [])
  {
    return self::post("/charge/submit_otp", $params);
  }

  /**
   * Submit Phone when requested
   *
   * @return \Illuminate\Http\Response
   */
  static function submitPhone($params = [])
  {
    return self::post("/charge/submit_phone", $params);
  }

  /**
   * Submit Birthday when requested
   *
   * @return \Illuminate\Http\Response
   */
  static function submitBirthday($params = [])
  {
    return self::post("/charge/submit_birthday", $params);
  }

  /**
   * Submit address to continue a charge
   *
   * @return \Illuminate\Http\Response
   */
  static function submitAddress($params = [])
  {
    return self::post("/charge/submit_address", $params);
  }

  /**
   * When you get "pending" as a charge status or if there was an exception
   * when calling any of the /charge endpoints, wait 10 seconds or more,
   * then make a check to see if its status has changed.
   * Don't call too early as you may get a lot more pending than you should.
   *
   * @return \Illuminate\Http\Response
   */
  static function checkPending($reference, $params = [])
  {
    return self::get("/charge/$reference", $params);
  }
}
