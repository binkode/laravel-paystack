<?php

namespace Binkode\Paystack;

use Illuminate\Support\Facades\Config;

class Paystack
{
  public function applePay(): Support\ApplePay
  {
    return new Support\ApplePay();
  }

  public function applePays(): Support\ApplePay
  {
    return $this->applePay();
  }

  public function bulkCharge(): Support\BulkCharge
  {
    return new Support\BulkCharge();
  }

  public function bulkCharges(): Support\BulkCharge
  {
    return $this->bulkCharge();
  }

  public function charge(): Support\Charge
  {
    return new Support\Charge();
  }

  public function charges(): Support\Charge
  {
    return $this->charge();
  }

  public function controlPanel(): Support\ControlPanel
  {
    return new Support\ControlPanel();
  }

  public function controlPanels(): Support\ControlPanel
  {
    return $this->controlPanel();
  }

  public function customer(): Support\Customer
  {
    return new Support\Customer();
  }

  public function customers(): Support\Customer
  {
    return $this->customer();
  }

  public function dedicatedVirtualAccount(): Support\DedicatedVirtualAccount
  {
    return new Support\DedicatedVirtualAccount();
  }

  public function dedicatedVirtualAccounts(): Support\DedicatedVirtualAccount
  {
    return $this->dedicatedVirtualAccount();
  }

  public function dispute(): Support\Dispute
  {
    return new Support\Dispute();
  }

  public function disputes(): Support\Dispute
  {
    return $this->dispute();
  }

  public function invoice(): Support\Invoice
  {
    return new Support\Invoice();
  }

  public function invoices(): Support\Invoice
  {
    return $this->invoice();
  }

  public function miscellaneous(): Support\Miscellaneous
  {
    return new Support\Miscellaneous();
  }

  public function miscellaneouses(): Support\Miscellaneous
  {
    return $this->miscellaneous();
  }

  public function order(): Support\Order
  {
    return new Support\Order();
  }

  public function orders(): Support\Order
  {
    return $this->order();
  }

  public function page(): Support\Page
  {
    return new Support\Page();
  }

  public function pages(): Support\Page
  {
    return $this->page();
  }

  public function plan(): Support\Plan
  {
    return new Support\Plan();
  }

  public function plans(): Support\Plan
  {
    return $this->plan();
  }

  public function product(): Support\Product
  {
    return new Support\Product();
  }

  public function products(): Support\Product
  {
    return $this->product();
  }

  public function recipient(): Support\Recipient
  {
    return new Support\Recipient();
  }

  public function recipients(): Support\Recipient
  {
    return $this->recipient();
  }

  public function refund(): Support\Refund
  {
    return new Support\Refund();
  }

  public function refunds(): Support\Refund
  {
    return $this->refund();
  }

  public function settlement(): Support\Settlement
  {
    return new Support\Settlement();
  }

  public function settlements(): Support\Settlement
  {
    return $this->settlement();
  }

  public function split(): Support\Split
  {
    return new Support\Split();
  }

  public function splits(): Support\Split
  {
    return $this->split();
  }

  public function subAccount(): Support\SubAccount
  {
    return new Support\SubAccount();
  }

  public function subAccounts(): Support\SubAccount
  {
    return $this->subAccount();
  }

  public function subscription(): Support\Subscription
  {
    return new Support\Subscription();
  }

  public function subscriptions(): Support\Subscription
  {
    return $this->subscription();
  }

  public function terminal(): Support\Terminal
  {
    return new Support\Terminal();
  }

  public function terminals(): Support\Terminal
  {
    return $this->terminal();
  }

  public function transaction(): Support\Transaction
  {
    return new Support\Transaction();
  }

  public function transactions(): Support\Transaction
  {
    return $this->transaction();
  }

  public function transfer(): Support\Transfer
  {
    return new Support\Transfer();
  }

  public function transfers(): Support\Transfer
  {
    return $this->transfer();
  }

  public function transferControl(): Support\TransferControl
  {
    return new Support\TransferControl();
  }

  public function transferControls(): Support\TransferControl
  {
    return $this->transferControl();
  }

  public function verification(): Support\Verification
  {
    return new Support\Verification();
  }

  public function verifications(): Support\Verification
  {
    return $this->verification();
  }

  public function virtualTerminal(): Support\VirtualTerminal
  {
    return new Support\VirtualTerminal();
  }

  public function virtualTerminals(): Support\VirtualTerminal
  {
    return $this->virtualTerminal();
  }

  /**
   * Dynamically handle calls to the class.
   *
   * @param string $method
   * @param array<mixed> $parameters
   * @return mixed
   *
   * @throws \BadMethodCallException
   */
  public function __call(string $method, array $parameters): mixed
  {
    $resolvedClass = $this->resolveSupportClass($method);

    if ($resolvedClass) {
      return new $resolvedClass();
    }

    throw new \BadMethodCallException("Method {$method} does not exist on " . get_class($this));
  }

  /**
   * Resolve method name to a support class.
   *
   * @param string $method
   * @return class-string|null
   */
  protected function resolveSupportClass(string $method): ?string
  {
    /** @var array<string, class-string> $mappings */
    $mappings = [
      'applepay' => Support\ApplePay::class,
      'applepays' => Support\ApplePay::class,
      'apple_pay' => Support\ApplePay::class,
      'apple_pays' => Support\ApplePay::class,

      'bulkcharge' => Support\BulkCharge::class,
      'bulkcharges' => Support\BulkCharge::class,
      'bulk_charge' => Support\BulkCharge::class,
      'bulk_charges' => Support\BulkCharge::class,

      'charge' => Support\Charge::class,
      'charges' => Support\Charge::class,

      'controlpanel' => Support\ControlPanel::class,
      'controlpanels' => Support\ControlPanel::class,
      'control_panel' => Support\ControlPanel::class,
      'control_panels' => Support\ControlPanel::class,

      'customer' => Support\Customer::class,
      'customers' => Support\Customer::class,

      'dedicatedvirtualaccount' => Support\DedicatedVirtualAccount::class,
      'dedicatedvirtualaccounts' => Support\DedicatedVirtualAccount::class,
      'dedicated_virtual_account' => Support\DedicatedVirtualAccount::class,
      'dedicated_virtual_accounts' => Support\DedicatedVirtualAccount::class,

      'dispute' => Support\Dispute::class,
      'disputes' => Support\Dispute::class,

      'invoice' => Support\Invoice::class,
      'invoices' => Support\Invoice::class,

      'miscellaneous' => Support\Miscellaneous::class,
      'miscellaneouses' => Support\Miscellaneous::class,

      'order' => Support\Order::class,
      'orders' => Support\Order::class,

      'page' => Support\Page::class,
      'pages' => Support\Page::class,

      'plan' => Support\Plan::class,
      'plans' => Support\Plan::class,

      'product' => Support\Product::class,
      'products' => Support\Product::class,

      'recipient' => Support\Recipient::class,
      'recipients' => Support\Recipient::class,

      'refund' => Support\Refund::class,
      'refunds' => Support\Refund::class,

      'settlement' => Support\Settlement::class,
      'settlements' => Support\Settlement::class,

      'split' => Support\Split::class,
      'splits' => Support\Split::class,

      'subaccount' => Support\SubAccount::class,
      'subaccounts' => Support\SubAccount::class,
      'sub_account' => Support\SubAccount::class,
      'sub_accounts' => Support\SubAccount::class,

      'subscription' => Support\Subscription::class,
      'subscriptions' => Support\Subscription::class,

      'terminal' => Support\Terminal::class,
      'terminals' => Support\Terminal::class,

      'transaction' => Support\Transaction::class,
      'transactions' => Support\Transaction::class,

      'transfer' => Support\Transfer::class,
      'transfers' => Support\Transfer::class,

      'transfercontrol' => Support\TransferControl::class,
      'transfercontrols' => Support\TransferControl::class,
      'transfer_control' => Support\TransferControl::class,
      'transfer_controls' => Support\TransferControl::class,

      'verification' => Support\Verification::class,
      'verifications' => Support\Verification::class,

      'virtualterminal' => Support\VirtualTerminal::class,
      'virtualterminals' => Support\VirtualTerminal::class,
      'virtual_terminal' => Support\VirtualTerminal::class,
      'virtual_terminals' => Support\VirtualTerminal::class,
    ];

    $key = strtolower(str_replace('_', '', $method));
    if (isset($mappings[$key])) {
      return $mappings[$key];
    }

    $cleaned = str_replace(['_', '-'], '', $method);

    $studly = $this->studly($cleaned);
    /** @var class-string $class */
    $class = "Binkode\\Paystack\\Support\\{$studly}";
    if (class_exists($class)) {
      return $class;
    }

    if (str_ends_with(strtolower($cleaned), 'es')) {
      $singular = substr($cleaned, 0, -2);
      $studlySingular = $this->studly($singular);
      /** @var class-string $classSingularEs */
      $classSingularEs = "Binkode\\Paystack\\Support\\{$studlySingular}";
      if (class_exists($classSingularEs)) {
        return $classSingularEs;
      }
    }

    if (str_ends_with(strtolower($cleaned), 's')) {
      $singular = substr($cleaned, 0, -1);
      $studlySingular = $this->studly($singular);
      /** @var class-string $classSingularS */
      $classSingularS = "Binkode\\Paystack\\Support\\{$studlySingular}";
      if (class_exists($classSingularS)) {
        return $classSingularS;
      }
    }

    return null;
  }

  /**
   * Convert value to studly case.
   *
   * @param string $value
   * @return string
   */
  protected function studly(string $value): string
  {
    $value = ucwords(str_replace(['-', '_'], ' ', $value));
    return str_replace(' ', '', $value);
  }
}
