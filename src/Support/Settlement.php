<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Settlements API allows you gain insights
 * into payouts made by Paystack to your bank account
 *
 */
class Settlement
{
  use Request;

  /**
   * Fetch settlements made to your settlement accounts.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/settlement", $params);
  }

  /**
   * Get the transactions that make up a particular settlement
   *
   * @return \Illuminate\Http\Response
   */
  static function transactions($settlement, $params = [])
  {
    return self::get("/settlement/$settlement/transactions", $params);
  }
}
