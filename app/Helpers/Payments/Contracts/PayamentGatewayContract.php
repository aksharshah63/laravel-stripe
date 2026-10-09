<?php

namespace App\Helpers\Payments\Contracts;

use App\Helpers\Payments\Responses\PaymentResponse;
use App\Models\Order;
use App\Models\Payment;

interface PayamentGatewayContract
{
    public function pay(Order $order): PaymentResponse;

    public function verifyPayment(Payment $payment): PaymentResponse;
}
