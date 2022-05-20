<?php

namespace Myckhel\Paystack\Support;

use Myckhel\Paystack\Traits\Request;

/**
 * The Products API allows you create and manage
 * inventories on your integration
 *
 */
class Product
{
  use Request;

  /**
   * Create a product on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/product", $params);
  }

  /**
   * List products available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/product", $params);
  }

  /**
   * Get details of a product on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($product, $params = [])
  {
    return self::get("/product/$product", $params);
  }

  /**
   * Update a product details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($product, $params = [])
  {
    return self::put("/product/$product", $params);
  }
}
