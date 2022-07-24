<?php

namespace Myckhel\Paystack;

use Illuminate\Support\ServiceProvider;
use Myckhel\Paystack\Http\Middleware\DisabledRoute;

class PaystackServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->loadRoutesFrom(__DIR__ . '/routes.php');

    $this->mergeConfigFrom(__DIR__ . '/../config/paystack.php', 'paystack');

    $this->app['router']->aliasMiddleware('paystack_route_disabled',   DisabledRoute::class);

    // Register the service the package provides.
    $this->app->singleton(
      'paystack',
      fn ($app) => new Paystack
    );
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  function provides()
  {
    return ['paystack'];
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
