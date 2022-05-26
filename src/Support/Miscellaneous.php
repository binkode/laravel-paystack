<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Miscellaneous API are supporting APIs that
 * can be used to provide more details to other APIs
 *
 */
class Miscellaneous
{
  use Request;

  /**
   * Get a list of all supported banks and their properties
   *
   * @return \Illuminate\Http\Response
   */
  static function listBanks($params = [])
  {
    return self::get("/bank", $params);
  }

  /**
   * Get a list of all providers for Dedicated Virtual Account
   *
   * @return \Illuminate\Http\Response
   */
  static function listProviders($params = [])
  {
    return self::get("/banks", $params);
  }

  /**
   * Gets a list of Countries that Paystack currently supports
   *
   * @return \Illuminate\Http\Response
   */
  static function listCountries($params = [])
  {
    return self::get("/country", $params);
  }

  /**
   * Get a list of states for a country for address verification.
   *
   * @return \Illuminate\Http\Response
   */
  static function listStates($params = [])
  {
    return self::get("/address_verification/states", $params);
  }
}
