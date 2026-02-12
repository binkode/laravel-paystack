<?php

namespace Binkode\Paystack\Tests;

use Binkode\Paystack\Facades\Paystack as PaystackFacade;
use Binkode\Paystack\Http\Middleware\DisabledRoute;
use Binkode\Paystack\Http\Middleware\ValidatePaystackHook;
use Binkode\Paystack\Paystack;
use Binkode\Paystack\PaystackConfig;

class ServiceProviderTest extends TestCase
{
  public function test_paystack_service_is_bound_as_singleton(): void
  {
    $first = $this->app->make('paystack');
    $second = $this->app->make('paystack');

    $this->assertInstanceOf(Paystack::class, $first);
    $this->assertSame($first, $second);
  }

  public function test_facade_resolves_the_paystack_singleton(): void
  {
    $resolved = PaystackFacade::getFacadeRoot();

    $this->assertInstanceOf(Paystack::class, $resolved);
    $this->assertSame($this->app->make('paystack'), $resolved);
  }

  public function test_default_config_values_are_merged_and_accessible(): void
  {
    $this->assertSame('https://api.paystack.co', config('paystack.url'));
    $this->assertSame('api', config('paystack.route.prefix'));
    $this->assertSame(['paystack_route_disabled', 'api'], config('paystack.route.middleware'));
    $this->assertSame(config('paystack.route.prefix'), PaystackConfig::config('route.prefix'));
  }

  public function test_route_middlewares_are_registered(): void
  {
    $middlewares = $this->app['router']->getMiddleware();

    $this->assertArrayHasKey('paystack_route_disabled', $middlewares);
    $this->assertSame(DisabledRoute::class, $middlewares['paystack_route_disabled']);

    $this->assertArrayHasKey('validate_paystack_hook', $middlewares);
    $this->assertSame(ValidatePaystackHook::class, $middlewares['validate_paystack_hook']);
  }
}
