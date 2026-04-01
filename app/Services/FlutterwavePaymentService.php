<?php

namespace App\Services;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;
use Exception;

class FlutterwavePaymentService
{
    protected string $baseUrl = "https://api.flutterwave.com/v3";
    protected string $secretKey;

    public function __construct()
    {
        $this->secretKey = config('services.flutterwave.secret_key');
    }

    /**
     * Generate a payment link for a Nigerian parent/school.
     */
    public function createPaymentLink(User $user, float $amount, string $currency = 'NGN'): array
    {
        $payload = [
            'tx_ref' => uniqid('eduteller_'),
            'amount' => $amount,
            'currency' => $currency,
            'redirect_url' => route('payments.callback'),
            'customer' => [
                'email' => $user->email,
                'name' => $user->name,
                'phonenumber' => $user->phone_number,
            ],
            'customizations' => [
                'title' => 'Eduteller Portal Subscription',
                'description' => 'F.I.T.S Model Consultancy & Narrative Learning Access',
                'logo' => asset('images/logo.png'),
            ],
            'payment_options' => 'card, ussd, account, transfer',
        ];

        $response = Http::withToken($this->secretKey)->post($this->baseUrl . "/payments", $payload);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        throw new Exception("Unable to create Flutterwave payment link: " . $response->body());
    }

    /**
     * Verify the transaction status after callback.
     */
    public function verifyTransaction(string $transactionId): bool
    {
        $response = Http::withToken($this->secretKey)->get($this->baseUrl . "/transactions/{$transactionId}/verify");

        if ($response->successful()) {
            $data = $response->json()['data'];
            return $data['status'] === 'successful' && $data['amount'] >= 0;
        }

        return false;
    }

    /**
     * Handle Flutterwave Webhook for asynchronous payment updates.
     */
    public function handleWebhook(array $payload, string $signature): bool
    {
        // 1. Verify Hash Signature (Security)
        if ($signature !== config('services.flutterwave.secret_hash')) {
            return false;
        }

        // 2. Process based on event type
        if ($payload['event'] === 'charge.completed') {
            $this->activateSubscription($payload['data']);
        }

        return true;
    }

    protected function activateSubscription(array $data): void
    {
        // Logic to grant user access to narrative modules and school investigations
    }
}
