<?php

namespace Binkode\Paystack\Tests\Support;

use Binkode\Paystack\Tests\TestCase;
use Binkode\Paystack\Support\Terminal;
use Illuminate\Support\Facades\Http;

class TerminalTest extends TestCase
{
  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('paystack.secret_key', 'sk_test_mockkey');
  }

  public function test_list_terminals()
  {
    Http::fake([
      'https://api.paystack.co/terminal*' => Http::response(['status' => true, 'data' => []], 200)
    ]);

    $response = Terminal::list();
    $this->assertTrue($response['status']);
    Http::assertSent(function ($request) {
      return $request->url() === 'https://api.paystack.co/terminal' && $request->method() === 'GET';
    });
  }

  public function test_fetch_terminal()
  {
    Http::fake([
      'https://api.paystack.co/terminal/term_123' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::fetch('term_123');
    $this->assertTrue($response['status']);
  }

  public function test_update_terminal()
  {
    Http::fake([
      'https://api.paystack.co/terminal/term_123' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::update('term_123', ['name' => 'New Name']);
    $this->assertTrue($response['status']);
    Http::assertSent(function ($request) {
      return $request->url() === 'https://api.paystack.co/terminal/term_123' &&
             $request->method() === 'PUT' &&
             $request['name'] === 'New Name';
    });
  }

  public function test_fetch_presence()
  {
    Http::fake([
      'https://api.paystack.co/terminal/term_123/presence' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::fetchPresence('term_123');
    $this->assertTrue($response['status']);
  }

  public function test_send_event()
  {
    Http::fake([
      'https://api.paystack.co/terminal/term_123/event' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::sendEvent('term_123', ['type' => 'invoice']);
    $this->assertTrue($response['status']);
  }

  public function test_fetch_event_status()
  {
    Http::fake([
      'https://api.paystack.co/terminal/term_123/event/evt_123' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::fetchEventStatus('term_123', 'evt_123');
    $this->assertTrue($response['status']);
  }

  public function test_commission()
  {
    Http::fake([
      'https://api.paystack.co/terminal/commission_device' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::commission(['serial_number' => '12345']);
    $this->assertTrue($response['status']);
  }

  public function test_decommission()
  {
    Http::fake([
      'https://api.paystack.co/terminal/decommission_device' => Http::response(['status' => true], 200)
    ]);

    $response = Terminal::decommission(['serial_number' => '12345']);
    $this->assertTrue($response['status']);
  }
}
