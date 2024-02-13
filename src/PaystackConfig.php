<?php

namespace Binkode\Paystack;

use Illuminate\Support\Facades\Config;

/**
 *
 */
class PaystackConfig
{
  static function config(String $config = null)
  {
    return Config::get("paystack" . ($config ? '.' . $config : ''));
  }
}
