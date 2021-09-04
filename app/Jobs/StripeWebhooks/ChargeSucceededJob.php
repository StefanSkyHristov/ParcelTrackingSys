<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Contracts\Queue\ShouldBeUnique;

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

        $user = User::where('stripe_id', $charge['customer'])->first();

        if($user)
        {
            Payment::create([
                'user_id' => $user->id,
                'stripe_id' => $charge['id'],
                'subtotal' => $charge['amount'],
                'total' => $charge['amount']
            ]);
        }
    }
}
