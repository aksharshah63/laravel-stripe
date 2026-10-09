<?php

namespace App\Services\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Repositories\PaymentRepository;

class PaymentService
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function create(Order $order, string $driver, float $amount): Payment
    {
        return $this->paymentRepository->create($order, $driver, $amount);
    }

    public function updateGatewayReferenceId(Payment $payment, string $gatewayTransactionId): Payment
    {
        return $this->paymentRepository->updateGatewayReferenceId($payment, $gatewayTransactionId);
    }

    public function updateStatus(Payment $payment, string $status): Payment
    {
        if (! in_array($status, [Payment::STATUS_PAID, Payment::STATUS_PENDING, Payment::STATUS_FAILED])) {
            throw new \InvalidArgumentException('Invalid status');
        }
        if ($status == $payment->status) {
            return $payment;
        }

        $payment->status = $status;
        $payment->save();

        return $payment;
    }
}
