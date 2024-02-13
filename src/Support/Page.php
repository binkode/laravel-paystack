<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Payment Pages API provides a quick and secure
 * way to collect payment for products.
 *
 */
class Page
{
  use Request;

  /**
   * Create a payment page on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/page", $params);
  }

  /**
   * List payment pages available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/page", $params);
  }

  /**
   * Get details of a payment page on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($page, $params = [])
  {
    return self::get("/page/$page", $params);
  }

  /**
   * Update a payment page details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($page, $params = [])
  {
    return self::put("/page/$page", $params);
  }

  /**
   * heck the availability of a slug for a payment page.
   *
   * @return \Illuminate\Http\Response
   */
  static function checkSlug($slug, $params = [])
  {
    return self::get("/page/$slug", $params);
  }

  /**
   * Add products to a payment page
   *
   * @return \Illuminate\Http\Response
   */
  static function addProduct($page, $params = [])
  {
    return self::post("/page/$page/product", $params);
  }
}
