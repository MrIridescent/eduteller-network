<?php

namespace App\Services;

use App\Models\User;
use Exception;

class SubscriptionService
{
    /**
     * Initialize a payment session via Flutterwave or Paystack.
     */
    public function initiatePayment(User $user, string $planId, string $gateway = 'flutterwave'): array
    {
        $amount = $this->getPlanAmount($planId);
        
        // Flutterwave/Paystack initialization logic
        return [
            'checkout_url' => "https://checkout.{$gateway}.com/pay/".uniqid(),
            'reference' => 'EDU-'.time(),
            'amount' => $amount
        ];
    }

    /**
     * Handle Webhook from Payment Provider.
     */
    public function handleWebhook(array $payload): bool
    {
        // Verify signature and payment status
        // Grant access to premium "Bonus Chapters"
        return true;
    }

    protected function getPlanAmount(string $planId): int
    {
        return match ($planId) {
            'parent_monthly' => 500000, // 5000 NGN in kobo/cents
            'school_annual' => 50000000, // 500,000 NGN
            default => 100000
        };
    }
}
