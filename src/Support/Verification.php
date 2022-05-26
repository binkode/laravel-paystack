<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Verification API allows you perform KYC processes
 *
 */
class Verification
{
  use Request;

  /**
   * Confirm an account belongs to the right customer
   *
   * @return \Illuminate\Http\Response
   */
  static function resolve($params = [])
  {
    return self::get("/bank/resolve", $params);
  }

  /**
   * Confirm an account belongs to the right customer
   *
   * @return \Illuminate\Http\Response
   */
  static function validateAccount($params = [])
  {
    return self::post("/bank/validate", $params);
  }

  /**
   * Confirm an account belongs to the right customer
   *
   * @return \Illuminate\Http\Response
   */
  static function resolveCardBIN($bin, $params = [])
  {
    return self::get("/decision/bin/$bin", $params);
  }
}
