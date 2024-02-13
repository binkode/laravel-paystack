<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

class Transaction
{
  use Request;

  /**
   * List transactions carried out on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/transaction", $params);
  }

  /**
   * Initialize a transaction from your backend.
   *
   * @return \Illuminate\Http\Response
   */
  static function initialize($params = [])
  {
    return self::post("/transaction/initialize", $params);
  }

  /**
   * Confirm the status of a transaction.
   *
   * @return \Illuminate\Http\Response
   */
  static function verify($reference, $params = [])
  {
    return self::get("/transaction/verify/$reference", $params);
  }

  /**
   * Get details of a transaction carried out on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($transaction, $params = [])
  {
    return self::get("/transaction/$transaction", $params);
  }

  /**
   * All authorizations marked as reusable can be charged with
   * this endpoint whenever you need to receive payments.
   *
   * @return \Illuminate\Http\Response
   */
  static function charge_authorization($params = [])
  {
    return self::post("/transaction/charge_authorization", $params);
  }

  /**
   * All Mastercard and Visa authorizations can be checked with this endpoint to know if they have funds for the payment you seek.
   * This endpoint should be used when you do not know the exact amount to charge a card when rendering a service.
   * It should be used to check if a card has enough funds based on a maximum range value.
   * It is well suited for:
   * Ride hailing services
   * Logistics services
   *
   * @return \Illuminate\Http\Response
   */
  static function check_authorization($params = [])
  {
    return self::post("/transaction/check_authorization", $params);
  }

  /**
   * View the timeline of a transaction
   *
   * @return \Illuminate\Http\Response
   */
  static function viewTimeline($id_or_reference, $params = [])
  {
    return self::get("/transaction/timeline/$id_or_reference", $params);
  }

  /**
   * Total amount received on your account
   *
   * @return \Illuminate\Http\Response
   */
  static function totals($params = [])
  {
    return self::get("/transaction/totals", $params);
  }

  /**
   * List transactions carried out on your integration.
   *
   * @return \Illuminate\Http\Response
   */
  static function export($params = [])
  {
    return self::get("/transaction/export", $params);
  }

  /**
   * Retrieve part of a payment from a customer
   *
   * @return \Illuminate\Http\Response
   */
  static function partial_debit($params = [])
  {
    return self::post("/transaction/partial_debit", $params);
  }
}
