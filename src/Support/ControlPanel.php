<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Control Panel API allows you manage some settings on your integration
 *
 */
class ControlPanel
{
  use Request;

  /**
   * Fetch the payment session timeout on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function fetchPaymentSessionTimeout($params = [])
  {
    return self::get("/integration/payment_session_timeout", $params);
  }

  /**
   * Update the payment session timeout on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function updatePaymentSessionTimeout($params = [])
  {
    return self::put("/integration/payment_session_timeout", $params);
  }
}
