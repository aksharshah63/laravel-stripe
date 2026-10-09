<?php

namespace App\Helpers\Payments;

use App\Helpers\Payments\Contracts\PayamentGatewayContract;

class RazorpayPaymentGateway implements PayamentGatewayContract
{
    public function pay(Order $order): PaymentResponse
    {
        // TODO: Implement Razorpay Payment Gateway logic here
    }
}
