<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Terminal API allows you to build in-person payment experiences
 * on Paystack physical terminals.
 *
 */
class Terminal
{
  use Request;

  /**
   * List terminals available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/terminal", $params);
  }

  /**
   * Get details of a terminal on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($terminal, $params = [])
  {
    return self::get("/terminal/$terminal", $params);
  }

  /**
   * Update terminal details.
   *
   * @return \Illuminate\Http\Response
   */
  static function update($terminal, $params = [])
  {
    return self::put("/terminal/$terminal", $params);
  }

  /**
   * Check the presence/status of a specific terminal.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetchPresence($terminal, $params = [])
  {
    return self::get("/terminal/$terminal/presence", $params);
  }

  /**
   * Send an event (e.g., transaction/invoice) to a specific terminal.
   *
   * @return \Illuminate\Http\Response
   */
  static function sendEvent($terminal, $params = [])
  {
    return self::post("/terminal/$terminal/event", $params);
  }

  /**
   * Check the status of an event sent to a terminal.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetchEventStatus($terminal, $event, $params = [])
  {
    return self::get("/terminal/$terminal/event/$event", $params);
  }

  /**
   * Link a debug device to your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function commission($params = [])
  {
    return self::post("/terminal/commission_device", $params);
  }

  /**
   * Unlink a debug device from your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function decommission($params = [])
  {
    return self::post("/terminal/decommission_device", $params);
  }
}
