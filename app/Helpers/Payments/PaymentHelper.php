<?php

namespace App\Helpers\Payments;

use App\Helpers\Payments\Responses\PaymentResponse;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Payment\PaymentService;

class PaymentHelper
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    private object $paymentGateway;

    public function driver(string $driver): PaymentHelper
    {
        $config = config('payments.gateways');
        if (! in_array($driver, array_keys($config))) {
            throw new \InvalidArgumentException("Driver {$driver} not supported", 422);
        }

        $this->paymentGateway = match ($driver) {
            'stripe' => new StripePaymentGateway($config['stripe'], $this->paymentService),
            'razorpay' => new RazorpayPaymentGateway($config['razorpay'], $this->paymentService),
            'paypal' => new PayPalPaymentGateway($config['paypal'], $this->paymentService),
            default => throw new \InvalidArgumentException("Driver {$driver} not supported", 422),
        };

        return $this;
    }

    public function pay(Order $order): PaymentResponse
    {
        return $this->paymentGateway->pay($order);
    }

    public function verifyPayment(Payment $payment): PaymentResponse
    {
        return $this->paymentGateway->verifyPayment($payment);
    }
}
