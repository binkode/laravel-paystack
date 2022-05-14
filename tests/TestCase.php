<?php

namespace Myckhel\Paystack\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
  /**
   * Get package providers.
   *
   * @param  \Illuminate\Foundation\Application  $app
   *
   * @return array
   */
  protected function getPackageProviders($app)
  {
    return [
      \Myckhel\Paystack\PaystackServiceProvider::class,
    ];
  }

  /**
   * Define environment setup.
   *
   * @param  \Illuminate\Foundation\Application   $app
   *
   * @return void
   */
  protected function getEnvironmentSetUp($app)
  {
    //
  }
}
