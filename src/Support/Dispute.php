<?php

namespace Binkode\Paystack\Support;

use Binkode\Paystack\Traits\Request;

/**
 * The Disputes API allows you manage transaction disputes on your integration
 *
 */
class Dispute
{
  use Request;

  /**
   * List disputes filed against you
   *
   * @return \Illuminate\Http\Response
   */
  static function list($params = [])
  {
    return self::get("/dispute", $params);
  }

  /**
   * Get more details about a dispute.
   *
   * @return \Illuminate\Http\Response
   */
  static function fetch($dispute, $params = [])
  {
    return self::get("/dispute/$dispute", $params);
  }

  /**
   * This endpoint retrieves disputes for a particular transaction
   *
   * @return \Illuminate\Http\Response
   */
  static function listTransaction($dispute, $params = [])
  {
    return self::get("/dispute/transaction/$dispute", $params);
  }

  /**
   * Update details of a dispute on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function update($dispute, $params = [])
  {
    return self::put("/dispute/$dispute", $params);
  }

  /**
   * Provide evidence for a dispute
   *
   * @return \Illuminate\Http\Response
   */
  static function addEvidence($dispute, $params = [])
  {
    return self::post("/dispute/$dispute/evidence", $params);
  }

  /**
   * Get URL to upload a dispute evidence.
   *
   * @return \Illuminate\Http\Response
   */
  static function getUploadURL($dispute, $params = [])
  {
    return self::get("/dispute/$dispute/upload_url", $params);
  }

  /**
   * Resolve a dispute on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function resolve($dispute, $params = [])
  {
    return self::put("/dispute/$dispute/resolve", $params);
  }

  /**
   * Export disputes available on your integration
   *
   * @return \Illuminate\Http\Response
   */
  static function export($params = [])
  {
    return self::get("/dispute/export", $params);
  }
}
