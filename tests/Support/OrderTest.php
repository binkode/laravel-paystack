<?php

namespace Binkode\Paystack\Tests\Support;

use Binkode\Paystack\Tests\TestCase;
use Binkode\Paystack\Support\Order;
use Illuminate\Support\Facades\Http;

class OrderTest extends TestCase
{
  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('paystack.secret_key', 'sk_test_mockkey');
  }

  public function test_create_order()
  {
    Http::fake([
      'https://api.paystack.co/order' => Http::response(['status' => true], 200)
    ]);

    $response = Order::create(['product' => 'prod_123']);
    $this->assertTrue($response['status']);
  }

  public function test_list_orders()
  {
    Http::fake([
      'https://api.paystack.co/order' => Http::response(['status' => true], 200)
    ]);

    $response = Order::list();
    $this->assertTrue($response['status']);
  }

  public function test_fetch_order()
  {
    Http::fake([
      'https://api.paystack.co/order/ord_123' => Http::response(['status' => true], 200)
    ]);

    $response = Order::fetch('ord_123');
    $this->assertTrue($response['status']);
  }

  public function test_fetch_product_orders()
  {
    Http::fake([
      'https://api.paystack.co/order/product/prod_123' => Http::response(['status' => true], 200)
    ]);

    $response = Order::fetchProductOrders('prod_123');
    $this->assertTrue($response['status']);
  }

  public function test_validate_order()
  {
    Http::fake([
      'https://api.paystack.co/order/ord_123/validate' => Http::response(['status' => true], 200)
    ]);

    $response = Order::validate('ord_123');
    $this->assertTrue($response['status']);
  }
}
