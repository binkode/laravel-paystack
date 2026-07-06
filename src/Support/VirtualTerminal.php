<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Virtual Terminal API allows you to create and manage in-person payments
 * without a physical POS device.
 *
 */
class VirtualTerminal
{
  use Request;

  /**
   * Create a virtual terminal on your integration.
   *
   * @return array
   */
  static function create($params = [])
  {
    return self::post("/virtual_terminal", $params);
  }

  /**
   * List virtual terminals available on your integration.
   *
   * @return array
   */
  static function list($params = [])
  {
    return self::get("/virtual_terminal", $params);
  }

  /**
   * Get details of a virtual terminal on your integration.
   *
   * @return array
   */
  static function fetch($virtual_terminal, $params = [])
  {
    return self::get("/virtual_terminal/$virtual_terminal", $params);
  }

  /**
   * Update virtual terminal details.
   *
   * @return array
   */
  static function update($virtual_terminal, $params = [])
  {
    return self::put("/virtual_terminal/$virtual_terminal", $params);
  }

  /**
   * Deactivate a virtual terminal.
   *
   * @return array
   */
  static function deactivate($virtual_terminal, $params = [])
  {
    return self::post("/virtual_terminal/$virtual_terminal/deactivate", $params);
  }

  /**
   * Assign destinations to a virtual terminal.
   *
   * @return array
   */
  static function assignDestination($virtual_terminal, $params = [])
  {
    return self::post("/virtual_terminal/$virtual_terminal/destinations", $params);
  }

  /**
   * Remove a destination from a virtual terminal.
   *
   * @return array
   */
  static function unassignDestination($virtual_terminal, $destinationId, $params = [])
  {
    return self::delete("/virtual_terminal/$virtual_terminal/destinations/$destinationId", $params);
  }
}
