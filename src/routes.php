<?php

use Illuminate\Support\Facades\Route;
use Myckhel\Paystack\Http\Controllers\ApplePayController;
use Myckhel\Paystack\Http\Controllers\BulkChargeController;
use Myckhel\Paystack\Http\Controllers\ChargeController;
use Myckhel\Paystack\Http\Controllers\ControlPanelController;
use Myckhel\Paystack\Http\Controllers\CustomerController;
use Myckhel\Paystack\Http\Controllers\DedicatedVirtualAccountController;
use Myckhel\Paystack\Http\Controllers\DisputeController;
use Myckhel\Paystack\Http\Controllers\TransactionController;
use Myckhel\Paystack\PaystackConfig;
use Myckhel\Paystack\Http\Controllers\HookController;
use Myckhel\Paystack\Http\Controllers\InvoiceController;
use Myckhel\Paystack\Http\Controllers\MiscellaneousController;
use Myckhel\Paystack\Http\Controllers\PageController;
use Myckhel\Paystack\Http\Controllers\PlanController;
use Myckhel\Paystack\Http\Controllers\ProductController;
use Myckhel\Paystack\Http\Controllers\RecipientController;
use Myckhel\Paystack\Http\Controllers\RefundController;
use Myckhel\Paystack\Http\Controllers\SettlementController;
use Myckhel\Paystack\Http\Controllers\SubAccountController;
use Myckhel\Paystack\Http\Controllers\SplitController;
use Myckhel\Paystack\Http\Controllers\SubscriptionController;
use Myckhel\Paystack\Http\Controllers\TransferControlController;
use Myckhel\Paystack\Http\Controllers\TransferController;
use Myckhel\Paystack\Http\Controllers\VerificationController;

$middleware       = PaystackConfig::config('route.middleware');
$prefix           = PaystackConfig::config('route.prefix');
$hook_middleware  = PaystackConfig::config('route.hook_middleware');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function () {
  $routes = [
    // transactions
    'get,transaction'                       => 'transaction,list',
    'post,transaction/initialize'           => 'transaction,initialize',
    'get,transaction/verify/{reference}'    => 'transaction,verify',
    'get,transaction/{transaction}'         => 'transaction,fetch',
    'post,transaction/charge_authorization' => 'transaction,charge_authorization',
    'post,transaction/check_authorization'  => 'transaction,check_authorization',
    'get,transaction/timeline/{id_or_reference}' => 'transaction,viewTimeline',
    'get,transaction/totals'      => 'transaction,totals',
    'get,transaction/export'      => 'transaction,export',
    'post,transaction/partial_debit'        => 'transaction,partial_debit',
    // splits
    'post,split'        => 'split,create',
    'get,split'         => 'split,list',
    'get,split/{split}' => 'split,fetch',
    'put,split/{split}' => 'split,update',
    'post,split/{split}/subaccount/add'     => 'split,add',
    'post,split/{split}/subaccount/remove'  => 'split,remove',
    // subaccounts
    'post,subaccount'       => 'subaccount,create',
    'get,subaccount'        => 'subaccount,list',
    'get,subaccount/{subaccount}' => 'subaccount,fetch',
    'put,subaccount/{subaccount}' => 'subaccount,update',
    // customers
    'post,customer'       => 'customer,create',
    'get,customer'        => 'customer,list',
    'get,customer/{customer}' => 'customer,fetch',
    'put,customer/{customer}' => 'customer,update',
    'post,customer/{customer}/identification' => 'customer,identification',
    'post,customer/set_risk_action' => 'customer,set_risk_action',
    'post,customer/deactivate_authorization' => 'customer,deactivate_authorization',
    // DedicatedVirtualAccount (dva)
    'post,dedicated_account'      => 'dva,create',
    'get,dedicated_account'       => 'dva,list',
    'get,dedicated_account/{dedicated_account}'       => 'dva,fetch',
    'delete,dedicated_account/{dedicated_account}'    => 'dva,remove',
    'post,dedicated_account/split'    => 'dva,split',
    'delete,dedicated_account/split'  => 'dva,removeSplit',
    'get,dedicated_account/available_providers'  => 'dva,providers',
    // apple pay
    'post,apple-pay/domain'     => 'apple,createDomain',
    'get,apple-pay/domain'      => 'apple,listDomains',
    'delete,apple-pay/domain'   => 'apple,removeDomain',
    // plans
    'post,plan'                 => 'plan,create',
    'get,plan'                  => 'plan,list',
    'get,plan/{plan}'           => 'plan,fetch',
    'put,plan/{plan}'           => 'plan,update',
    // subscriptions
    'post,subscription'                 => 'subscription,create',
    'get,subscription'                  => 'subscription,list',
    'get,subscription/{subscription}'   => 'subscription,fetch',
    'post,subscription/enable'          => 'subscription,enable',
    'post,subscription/disable'         => 'subscription,disable',
    'get,subscription/{code}/manage/link'  => 'subscription,link',
    'post,subscription/{code}/manage/email' => 'subscription,sendUpdateSubscription',
    // products
    'post,product'                 => 'product,create',
    'get,product'                  => 'product,list',
    'get,product/{product}'        => 'product,fetch',
    'put,product/{product}'        => 'product,update',
    // pages
    'post,page'                 => 'page,create',
    'get,page'                  => 'page,list',
    'get,page/{page}'           => 'page,fetch',
    'put,page/{page}'           => 'page,update',
    'get,page/check_slug_availability/{slug}' => 'page,checkSlug',
    'post,page/{page}/product'  => 'page,addProduct',
    // invoices
    'post,paymentrequest'                 => 'invoice,create',
    'get,paymentrequest'                  => 'invoice,list',
    'get,paymentrequest/{invoice}'        => 'invoice,fetch',
    'put,paymentrequest/{invoice}'        => 'invoice,update',
    'get,paymentrequest/verify/{invoice_code}'    => 'invoice,verify',
    'post,paymentrequest/notify/{invoice_code}'   => 'invoice,notify',
    'get,paymentrequest/totals'   => 'invoice,totals',
    'post,paymentrequest/finalize/{invoice_code}' => 'invoice,finalize',
    'post,paymentrequest/archive/{invoice_code}'  => 'invoice,archive',
    // settlements
    'get,settlement'    => 'settlement,list',
    'get,settlement/{settlement}/transactions'    => 'settlement,transactions',
    // transferrecipients
    'post,transferrecipient'                 => 'transferrecipt,create',
    'post,transferrecipient/bulk'            => 'transferrecipt,bulkCreate',
    'get,transferrecipient'                  => 'transferrecipt,list',
    'get,transferrecipient/{transferrecipient}'     => 'transferrecipt,fetch',
    'put,transferrecipient/{transferrecipient}'     => 'transferrecipt,update',
    'delete,transferrecipient/{transferrecipient}'  => 'transferrecipt,remove',
    // pages
    'post,transfer'                 => 'transfer,initiate',
    'post,transfer/finalize_transfer' => 'transfer,finalize',
    'post,transfer/bulk'            => 'transfer,bulkCreate',
    'get,transfer'                  => 'transfer,list',
    'get,transfer/{transfer}'       => 'transfer,fetch',
    'get,transfer/verify/{reference}' => 'transfer,verify',
    // transfer control
    'get,balance'                   => 'control,balance',
    'get,balance/ledger'            => 'control,balanceLedger',
    'post,transfer/resend_otp'      => 'control,resendTransfersOTP',
    'post,transfer/disable_otp'     => 'control,disableTransfersOTP',
    'post,transfer/disable_otp_finalize'  => 'control,finalizeDisableOTP',
    'post,transfer/enable_otp'      => 'control,enableTransfersOTP',
    // bulk charges
    'post,bulkcharge'                 => 'bulkcharge,initiate',
    'get,bulkcharge'                  => 'bulkcharge,list',
    'get,bulkcharge/{bulkcharge}'     => 'bulkcharge,fetch',
    'get,bulkcharge/{bulkcharge}/charges' => 'bulkcharge,fetchChargesBatch',
    'get,bulkcharge/pause/{bulkcharge}'   => 'bulkcharge,pauseChargesBatch',
    'get,bulkcharge/resume/{bulkcharge}'  => 'bulkcharge,resumeChargesBatch',
    // control panel
    'get,integration/payment_session_timeout' => 'controlpanel,fetchPaymentSessionTimeout',
    'put,integration/payment_session_timeout' => 'controlpanel,updatePaymentSessionTimeout',
    // charges
    'post,charge'                 => 'charge,create',
    'post,charge/submit_pin'      => 'charge,submitPin',
    'post,charge/submit_otp'      => 'charge,submitOtp',
    'post,charge/submit_phone'    => 'charge,submitPhone',
    'post,charge/submit_birthday' => 'charge,submitBirthday',
    'post,charge/submit_address'  => 'charge,submitAddress',
    'get,charge/{reference}'      => 'charge,checkPending',
    // disputes
    'get,dispute'             => 'dispute,list',
    'get,dispute/{dispute}'   => 'dispute,fetch',
    'get,dispute/transaction/{dispute}'   => 'dispute,listTransaction',
    'put,dispute/{dispute}'   => 'dispute,update',
    'post,dispute/{dispute}/evidence'     => 'dispute,addEvidence',
    'get,dispute/{dispute}/upload_url'    => 'dispute,getUploadURL',
    'put,dispute/{dispute}/resolve'       => 'dispute,resolve',
    'get,dispute/{dispute}/export'        => 'dispute,export',
    // refunds
    'post,refund'           => 'refund,create',
    'get,refund'            => 'refund,list',
    'get,refund/{refund}'   => 'refund,fetch',
    // verifications
    'get,bank/resolve'        => 'verification,resolve',
    'post,bank/validate'      => 'verification,validateAccount',
    'get,decision/bin/{bin}'  => 'verification,resolveCardBIN',
    // miscellaneous
    'get,bank'        => 'miscellaneous,listBanks',
    'get,banks'       => 'miscellaneous,listProviders',
    'get,country'     => 'miscellaneous,listCountries',
    'get,address_verification/states'     => 'miscellaneous,listStates',
  ];

  $controls = [
    'transaction'     => TransactionController::class,
    'subaccount'      => SubAccountController::class,
    'split'           => SplitController::class,
    'customer'        => CustomerController::class,
    'dva'             => DedicatedVirtualAccountController::class,
    'apple'           => ApplePayController::class,
    'plan'            => PlanController::class,
    'subscription'    => SubscriptionController::class,
    'product'         => ProductController::class,
    'page'            => PageController::class,
    'invoice'         => InvoiceController::class,
    'settlement'      => SettlementController::class,
    'transferrecipt'  => RecipientController::class,
    'transfer'        => TransferController::class,
    'control'         => TransferControlController::class,
    'bulkcharge'      => BulkChargeController::class,
    'controlpanel'    => ControlPanelController::class,
    'charge'          => ChargeController::class,
    'dispute'         => DisputeController::class,
    'refund'          => RefundController::class,
    'verification'    => VerificationController::class,
    'miscellaneous'   => MiscellaneousController::class,
  ];

  collect($routes)->map(function ($route, $index) use ($controls) {
    [$method, $endpoint] = explode(',', $index);
    [$control, $func] = explode(',', $route);
    Route::$method($endpoint, [$controls[$control], $func]);
  });
});

// hooks
Route::post('hooks', [HookController::class, 'hook'])
  ->prefix($prefix)
  ->middleware($hook_middleware);
