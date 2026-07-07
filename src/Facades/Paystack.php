<?php

namespace Binkode\Paystack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Binkode\Paystack\Support\ApplePay applePay()
 * @method static \Binkode\Paystack\Support\ApplePay applePays()
 * @method static \Binkode\Paystack\Support\BulkCharge bulkCharge()
 * @method static \Binkode\Paystack\Support\BulkCharge bulkCharges()
 * @method static \Binkode\Paystack\Support\Charge charge()
 * @method static \Binkode\Paystack\Support\Charge charges()
 * @method static \Binkode\Paystack\Support\ControlPanel controlPanel()
 * @method static \Binkode\Paystack\Support\ControlPanel controlPanels()
 * @method static \Binkode\Paystack\Support\Customer customer()
 * @method static \Binkode\Paystack\Support\Customer customers()
 * @method static \Binkode\Paystack\Support\DedicatedVirtualAccount dedicatedVirtualAccount()
 * @method static \Binkode\Paystack\Support\DedicatedVirtualAccount dedicatedVirtualAccounts()
 * @method static \Binkode\Paystack\Support\Dispute dispute()
 * @method static \Binkode\Paystack\Support\Dispute disputes()
 * @method static \Binkode\Paystack\Support\Invoice invoice()
 * @method static \Binkode\Paystack\Support\Invoice invoices()
 * @method static \Binkode\Paystack\Support\Miscellaneous miscellaneous()
 * @method static \Binkode\Paystack\Support\Miscellaneous miscellaneouses()
 * @method static \Binkode\Paystack\Support\Order order()
 * @method static \Binkode\Paystack\Support\Order orders()
 * @method static \Binkode\Paystack\Support\Page page()
 * @method static \Binkode\Paystack\Support\Page pages()
 * @method static \Binkode\Paystack\Support\Plan plan()
 * @method static \Binkode\Paystack\Support\Plan plans()
 * @method static \Binkode\Paystack\Support\Product product()
 * @method static \Binkode\Paystack\Support\Product products()
 * @method static \Binkode\Paystack\Support\Recipient recipient()
 * @method static \Binkode\Paystack\Support\Recipient recipients()
 * @method static \Binkode\Paystack\Support\Refund refund()
 * @method static \Binkode\Paystack\Support\Refund refunds()
 * @method static \Binkode\Paystack\Support\Settlement settlement()
 * @method static \Binkode\Paystack\Support\Settlement settlements()
 * @method static \Binkode\Paystack\Support\Split split()
 * @method static \Binkode\Paystack\Support\Split splits()
 * @method static \Binkode\Paystack\Support\SubAccount subAccount()
 * @method static \Binkode\Paystack\Support\SubAccount subAccounts()
 * @method static \Binkode\Paystack\Support\Subscription subscription()
 * @method static \Binkode\Paystack\Support\Subscription subscriptions()
 * @method static \Binkode\Paystack\Support\Terminal terminal()
 * @method static \Binkode\Paystack\Support\Terminal terminals()
 * @method static \Binkode\Paystack\Support\Transaction transaction()
 * @method static \Binkode\Paystack\Support\Transaction transactions()
 * @method static \Binkode\Paystack\Support\Transfer transfer()
 * @method static \Binkode\Paystack\Support\Transfer transfers()
 * @method static \Binkode\Paystack\Support\TransferControl transferControl()
 * @method static \Binkode\Paystack\Support\TransferControl transferControls()
 * @method static \Binkode\Paystack\Support\Verification verification()
 * @method static \Binkode\Paystack\Support\Verification verifications()
 * @method static \Binkode\Paystack\Support\VirtualTerminal virtualTerminal()
 * @method static \Binkode\Paystack\Support\VirtualTerminal virtualTerminals()
 *
 * @see \Binkode\Paystack\Paystack
 */
class Paystack extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor(): string
  {
    return 'paystack';
  }
}
