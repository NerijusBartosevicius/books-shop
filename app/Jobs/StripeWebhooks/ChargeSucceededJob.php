<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;


    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];
        session()->remove('cart');
        Payment::create(
            [
                'email' => $charge['billing_details']['email'],
                'name' => $charge['billing_details']['name'],
                'stripe_id' => $charge['id'],
                'total' => $charge['amount']
            ]
        );
    }
}
