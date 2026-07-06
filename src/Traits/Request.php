<?php

namespace Binkode\Paystack\Traits;

use Illuminate\Support\Facades\Http;
use Binkode\Paystack\PaystackConfig;

#[\AllowDynamicProperties]
class Props
{
  public ?string $secret_key = null;
  public ?string $url = null;
  public ?string $public_key = null;
  public ?string $merchant_email = null;
  public mixed $route = null;

  /**
   * @param array<mixed> $props
   */
  function __construct(array $props)
  {
    collect($props)->map(
      fn ($value, $key) =>
      $this->$key = is_array($value) ? new self($value) : $value
    );
  }

  /**
   * @return mixed
   */
  public function __get(string $name)
  {
    return $this->$name ?? null;
  }
}


trait Request
{
  public static function config(): Props
  {
    $config = PaystackConfig::config();
    return new Props(is_array($config) ? $config : []);
  }

  /**
   * @param string $endpoint
   * @param array<string, mixed> $params
   * @param string|null $version
   * @return mixed
   */
  public static function post(string $endpoint, array $params = [], ?string $version = null): mixed
  {
    return self::request($endpoint, $params, 'post', $version);
  }

  /**
   * @param string $endpoint
   * @param array<string, mixed> $params
   * @param string|null $version
   * @return mixed
   */
  public static function delete(string $endpoint, array $params = [], ?string $version = null): mixed
  {
    return self::request($endpoint, $params, 'delete', $version);
  }

  /**
   * @param string $endpoint
   * @param array<string, mixed> $params
   * @param string|null $version
   * @return mixed
   */
  public static function put(string $endpoint, array $params = [], ?string $version = null): mixed
  {
    return self::request($endpoint, $params, 'put', $version);
  }

  /**
   * @param string $endpoint
   * @param array<string, mixed> $params
   * @param string|null $version
   * @return mixed
   */
  public static function get(string $endpoint, array $params = [], ?string $version = null): mixed
  {
    return self::request($endpoint, $params, 'get', $version);
  }

  /**
   * @param array<mixed> $ar
   * @param array<mixed> $arr
   * @return array<mixed>
   */
  public static function merge(array $ar, array $arr): array
  {
    return array_merge($ar, $arr);
  }

  /**
   * @param string $endpoint
   * @param array<string, mixed> $params
   * @param string $method
   * @param string|null $version
   * @return mixed
   */
  public static function request(string $endpoint, array $params, string $method = 'get', ?string $version = null): mixed
  {
    $cm       = self::config();
    $secretKey = $cm->secret_key ?? '';
    $authBearer = "Bearer " . $secretKey;
    $url = $cm->url ?? '';

    $res = Http::withHeaders([
      'Authorization' => $authBearer,
      'Content-Type'  => 'application/json',
      'Accept'        => 'application/json'
    ])
      ->baseUrl($url)
      ->$method(
        $endpoint,
        $params
      );

    if ($res->failed()) {
      abort($res->status(), (string) ($res->json()['message'] ?? ''));
    } else {
      return $res->json();
    }
  }
}
