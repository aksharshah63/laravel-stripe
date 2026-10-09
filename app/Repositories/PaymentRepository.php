<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentRepository extends BaseRepository
{
    public function store(Request $request)
    {
        // Not implemented for PaymentRepository
    }

    public function create(Order $order, string $driver, float $amount): Payment
    {
        $payment = new Payment;
        $payment->order_id = $order->id;
        $payment->transaction_id = 'T-'.$order->id.time().mt_rand(1000, 9999);
        $payment->driver = $driver;
        $payment->amount = $amount;
        $payment->currency_code = 'INR';
        $payment->save();

        return $payment;
    }

    public function updateGatewayReferenceId(Payment $payment, string $gatewayTransactionId): Payment
    {
        $payment->gateway_transaction_id = $gatewayTransactionId;
        $payment->save();

        return $payment;
    }

    public function handle() {}
}
