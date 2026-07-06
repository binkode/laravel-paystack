<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Orders API allows you to manage product orders.
 *
 */
class Order
{
  use Request;

  /**
   * Create an order on your integration.
   *
   * @return array
   */
  static function create($params = [])
  {
    return self::post("/order", $params);
  }

  /**
   * List orders available on your integration.
   *
   * @return array
   */
  static function list($params = [])
  {
    return self::get("/order", $params);
  }

  /**
   * Get details of an order on your integration.
   *
   * @return array
   */
  static function fetch($order, $params = [])
  {
    return self::get("/order/$order", $params);
  }

  /**
   * Get orders associated with a product.
   *
   * @return array
   */
  static function fetchProductOrders($product, $params = [])
  {
    return self::get("/order/product/$product", $params);
  }

  /**
   * Validate an order.
   *
   * @return array
   */
  static function validate($order, $params = [])
  {
    return self::get("/order/validate/$order", $params);
  }
}
