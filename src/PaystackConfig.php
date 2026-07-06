<?php

namespace Binkode\Paystack;

use Illuminate\Support\Facades\Config;

/**
 *
 */
class PaystackConfig
{
  /**
   * @param string|null $config
   * @return mixed
   */
  static function config(?string $config = null): mixed
  {
    return Config::get("paystack" . ($config ? '.' . $config : ''));
  }
}
