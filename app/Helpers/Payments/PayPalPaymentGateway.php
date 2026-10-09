<?php

namespace App\Helpers\Payments;

use App\Helpers\Payments\Contracts\PayamentGatewayContract;
use App\Helpers\Payments\Responses\PaymentResponse;
use App\Models\Order;

class PayPalPaymentGateway implements PayamentGatewayContract
{
    public function pay(Order $order): PaymentResponse
    {
        // TODO: Implement PayPal Payment Gateway logic here
    }
}
