<?php

namespace Binkode\Paystack\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Hook
{
  use Dispatchable, SerializesModels;

  public $event;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($event)
  {
    $this->event = $event;
  }
}
