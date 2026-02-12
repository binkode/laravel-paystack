<?php

namespace Binkode\Paystack\Tests;

use Binkode\Paystack\Http\Controllers\HookController;
use Binkode\Paystack\Http\Controllers\TransactionController;
use Illuminate\Routing\Route;

class RoutesTest extends TestCase
{
  public function test_transaction_list_route_is_registered(): void
  {
    $route = $this->findRouteByAction(TransactionController::class . '@list');

    $this->assertInstanceOf(Route::class, $route);
    $this->assertContains('GET', $route->methods());
  }

  public function test_hook_route_is_registered(): void
  {
    $route = $this->findRouteByAction(HookController::class . '@hook');

    $this->assertInstanceOf(Route::class, $route);
    $this->assertStringContainsString('hooks', $route->uri());
    $this->assertContains('POST', $route->methods());
  }

  private function findRouteByAction(string $action): ?Route
  {
    foreach ($this->app['router']->getRoutes() as $route) {
      if ($route->getActionName() === $action) {
        return $route;
      }
    }

    return null;
  }
}
