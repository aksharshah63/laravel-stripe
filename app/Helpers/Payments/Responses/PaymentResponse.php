<?php

namespace App\Helpers\Payments\Responses;

use App\Models\Order;

class PaymentResponse
{
    private bool $success;

    private string $message;

    private Order $order;

    public string $redirectUrl;

    private mixed $rawData;

    public function __construct() {}

    public function setSuccess(bool $success): PaymentResponse
    {
        $this->success = $success;

        return $this;
    }

    public function setMessage(string $message): PaymentResponse
    {
        $this->message = $message;

        return $this;
    }

    public function setOrder(Order $order): PaymentResponse
    {
        $this->order = $order;

        return $this;
    }

    public function setRawData(mixed $rawData): PaymentResponse
    {
        $this->rawData = $rawData;

        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getRawData(): mixed
    {
        return $this->rawData;
    }

    public function setRedirectUrl(string $redirectUrl): PaymentResponse
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
