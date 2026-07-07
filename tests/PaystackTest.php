<?php

namespace Binkode\Paystack\Tests;

use Binkode\Paystack\Facades\Paystack;
use Binkode\Paystack\Support\Customer;
use Binkode\Paystack\Support\Transaction;
use Binkode\Paystack\Support\DedicatedVirtualAccount;
use Illuminate\Support\Facades\Http;
use BadMethodCallException;

class PaystackTest extends TestCase
{
  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('paystack.secret_key', 'sk_test_mockkey');
  }

  public function test_facade_resolves_singular_and_plural_methods(): void
  {
    $this->assertInstanceOf(Transaction::class, Paystack::transaction());
    $this->assertInstanceOf(Transaction::class, Paystack::transactions());

    $this->assertInstanceOf(Customer::class, Paystack::customer());
    $this->assertInstanceOf(Customer::class, Paystack::customers());
  }

  public function test_dynamic_fallback_resolves_methods(): void
  {
    // Test direct mapping
    $this->assertInstanceOf(DedicatedVirtualAccount::class, Paystack::dedicatedVirtualAccount());
    $this->assertInstanceOf(DedicatedVirtualAccount::class, Paystack::dedicatedVirtualAccounts());

    // Test snake case
    $this->assertInstanceOf(DedicatedVirtualAccount::class, Paystack::dedicated_virtual_account());
    $this->assertInstanceOf(DedicatedVirtualAccount::class, Paystack::dedicated_virtual_accounts());
  }

  public function test_invalid_method_throws_exception(): void
  {
    $this->expectException(BadMethodCallException::class);
    Paystack::nonExistentEndpoint();
  }

  public function test_transactions_initialize_api_call(): void
  {
    Http::fake([
      'https://api.paystack.co/transaction/initialize' => Http::response(['status' => true, 'data' => ['authorization_url' => 'https://checkout.paystack.com']], 200)
    ]);

    $response = Paystack::transactions()->initialize([
      'amount' => 10000,
      'email' => 'user@example.com'
    ]);

    $this->assertTrue($response['status']);
    $this->assertSame('https://checkout.paystack.com', $response['data']['authorization_url']);

    Http::assertSent(function ($request) {
      return $request->url() === 'https://api.paystack.co/transaction/initialize' &&
             $request->method() === 'POST' &&
             $request['amount'] === 10000 &&
             $request['email'] === 'user@example.com';
    });
  }

  public function test_customers_create_api_call(): void
  {
    Http::fake([
      'https://api.paystack.co/customer' => Http::response(['status' => true, 'data' => ['customer_code' => 'CUS_123']], 200)
    ]);

    $response = Paystack::customers()->create([
      'email' => 'customer@example.com',
      'first_name' => 'John',
      'last_name' => 'Doe'
    ]);

    $this->assertTrue($response['status']);
    $this->assertSame('CUS_123', $response['data']['customer_code']);

    Http::assertSent(function ($request) {
      return $request->url() === 'https://api.paystack.co/customer' &&
             $request->method() === 'POST' &&
             $request['email'] === 'customer@example.com';
    });
  }
}
