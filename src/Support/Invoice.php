<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Invoices API allows you issue out and manage payment requests
 *
 */
class Invoice
{
  use Request;

  /**
   * Create a invoice on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function create($params = [])
  {
    return self::post("/paymentrequest", $params);
  }

  /**
   * List invoices available on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/paymentrequest", $params);
  }

  /**
   * Get details of a invoice on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($invoice, $params = [])
  {
    return self::get("/paymentrequest/$invoice", $params);
  }

  /**
   * Update a invoice details on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($invoice, $params = [])
  {
    return self::put("/paymentrequest/$invoice", $params);
  }

  /**
   * Verify details of an invoice on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function verify($code, $params = [])
  {
    return self::get("/paymentrequest/verify/$code", $params);
  }

  /**
   * Send notification of an invoice to your customers
   *
   * @return \Illuminate\Http\Response
   */
  static function notify($code, $params = [])
  {
    return self::post("/paymentrequest/notify/$code", $params);
  }

  /**
   * Get invoice metrics for dashboard
   *
   * @return \Illuminate\Http\Response
   */
  static function totals($params = [])
  {
    return self::get("/paymentrequest/totals", $params);
  }

  /**
   * Get invoice metrics for dashboard
   *
   * @return \Illuminate\Http\Response
   */
  static function finalize($code, $params = [])
  {
    return self::post("/paymentrequest/finalize/$code", $params);
  }

  /**
   * Used to archive an invoice. Invoice will no longer
   * be fetched on list or returned on verify.
   *
   * @return \Illuminate\Http\Response
   */
  static function archive($code, $params = [])
  {
    return self::post("/paymentrequest/archive/$code", $params);
  }
}
