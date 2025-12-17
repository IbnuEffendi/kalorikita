<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function createSnapToken(Order $order, array $customerDetails, array $itemDetails): string
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_code,
                'gross_amount' => (int) $order->total_harga,
            ],
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails,
        ];

        return Snap::getSnapToken($params);
    }

    public function verifySignature(string $orderId, string $statusCode, string $grossAmount, string $signatureKey): bool
    {
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.server_key'));

        return hash_equals($expectedSignature, $signatureKey);
    }

    public function mapTransactionStatus(?string $transactionStatus, ?string $fraudStatus = null): string
    {
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            return $fraudStatus === 'challenge' ? 'pending' : 'aktif';
        }

        if ($transactionStatus === 'pending') {
            return 'pending';
        }

        if ($transactionStatus === 'expire') {
            return 'expired';
        }

        if (in_array($transactionStatus, ['cancel', 'deny', 'failure'])) {
            return 'failed';
        }

        return 'pending';
    }
}
