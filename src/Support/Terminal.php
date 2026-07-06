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
   * @return array
   */
  static function list($params = [])
  {
    return self::get("/terminal", $params);
  }

  /**
   * Get details of a terminal on your integration.
   *
   * @return array
   */
  static function fetch($terminal, $params = [])
  {
    return self::get("/terminal/$terminal", $params);
  }

  /**
   * Update terminal details.
   *
   * @return array
   */
  static function update($terminal, $params = [])
  {
    return self::put("/terminal/$terminal", $params);
  }

  /**
   * Check the presence/status of a specific terminal.
   *
   * @return array
   */
  static function fetchPresence($terminal, $params = [])
  {
    return self::get("/terminal/$terminal/presence", $params);
  }

  /**
   * Send an event (e.g., transaction/invoice) to a specific terminal.
   *
   * @return array
   */
  static function sendEvent($terminal, $params = [])
  {
    return self::post("/terminal/$terminal/event", $params);
  }

  /**
   * Check the status of an event sent to a terminal.
   *
   * @return array
   */
  static function fetchEventStatus($terminal, $event, $params = [])
  {
    return self::get("/terminal/$terminal/event/$event", $params);
  }

  /**
   * Link a debug device to your integration.
   *
   * @return array
   */
  static function commission($params = [])
  {
    return self::post("/terminal/commission_device", $params);
  }

  /**
   * Unlink a debug device from your integration.
   *
   * @return array
   */
  static function decommission($params = [])
  {
    return self::post("/terminal/decommission_device", $params);
  }
}
