<?php

namespace Binkode\Paystack\Tests\Support;

use Binkode\Paystack\Tests\TestCase;
use Binkode\Paystack\Support\VirtualTerminal;
use Illuminate\Support\Facades\Http;

class VirtualTerminalTest extends TestCase
{
  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('paystack.secret_key', 'sk_test_mockkey');
  }

  public function test_create_virtual_terminal()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::create(['title' => 'Test VT']);
    $this->assertTrue($response['status']);
  }

  public function test_list_virtual_terminals()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::list();
    $this->assertTrue($response['status']);
  }

  public function test_fetch_virtual_terminal()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal/vt_123' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::fetch('vt_123');
    $this->assertTrue($response['status']);
  }

  public function test_update_virtual_terminal()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal/vt_123' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::update('vt_123', ['title' => 'Updated VT']);
    $this->assertTrue($response['status']);
  }

  public function test_deactivate_virtual_terminal()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal/vt_123/deactivate' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::deactivate('vt_123');
    $this->assertTrue($response['status']);
  }

  public function test_assign_destination()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal/vt_123/destinations' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::assignDestination('vt_123', ['destination' => 'Test']);
    $this->assertTrue($response['status']);
  }

  public function test_unassign_destination()
  {
    Http::fake([
      'https://api.paystack.co/virtual_terminal/vt_123/destinations/dest_123' => Http::response(['status' => true], 200)
    ]);

    $response = VirtualTerminal::unassignDestination('vt_123', 'dest_123');
    $this->assertTrue($response['status']);
  }
}
