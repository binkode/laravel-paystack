<?php

namespace Myckhel\Paystack\Traits;

use Illuminate\Support\Facades\Config;

/**
 *
 */
trait PaystackConfig
{
  static function config(String $config = null)
  {
    return Config::get("paystack" . ($config ? '.' . $config : ''));
  }
}
