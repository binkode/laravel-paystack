<?php

namespace Binkode\Paystack\Traits;

use Illuminate\Support\Facades\Http;
use Binkode\Paystack\PaystackConfig;

class Props
{
  function __construct(array $props)
  {
    collect($props)->map(
      fn ($value, $key) =>
      $this->$key = is_array($value) ? new self($value) : $value
    );
  }
}


trait Request
{
  public static function config()
  {
    return new Props(PaystackConfig::config());
  }

  public static function post($endpoint, $params = [], $version = null)
  {
    return self::request($endpoint, $params, 'post', $version);
  }

  public static function delete($endpoint, $params = [], $version = null)
  {
    return self::request($endpoint, $params, 'delete', $version);
  }

  public static function put($endpoint, $params = [], $version = null)
  {
    return self::request($endpoint, $params, 'put', $version);
  }

  public static function get($endpoint, $params = [], $version = null)
  {
    return self::request($endpoint, $params, 'get', $version);
  }

  public static function merge($ar, $arr)
  {
    return array_merge($ar, $arr);
  }

  public static function request($endpoint, $params, $method = 'get')
  {
    $cm       = self::config();
    $authBearer = "Bearer $cm->secret_key";

    $res = Http::withHeaders([
      'Authorization' => $authBearer,
      'Content-Type'  => 'application/json',
      'Accept'        => 'application/json'
    ])
      ->baseUrl($cm->url)
      ->$method(
        $endpoint,
        $params
      );

    if ($res->failed()) {
      abort($res->status(), $res->json()['message'] ?? '');
    } else {
      return $res->json();
    }
  }
}
