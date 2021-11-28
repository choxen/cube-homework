<?php

namespace App\Models;

class OrderData
{
    private string $orderNumber;
    private int $price;
    private int $deliveryPrice;
    private string $status;
    private string $client;
    private string $order;
    private string $payment_method;
    private int $productId;
    private int $productQuantity;

    public function __construct(array $data)
    {
        $this->orderNumber = $data['order_number'];
        $this->price = $data['price'];
        $this->deliveryPrice = $data['delivery_price'];
        $this->status = $data['status'];
        $this->client = serialize($data['client']);
        $this->order = serialize($data['order']);
        $this->payment_method = serialize($data['payment_method']);
        $this->productId = $data['product_id'];
        $this->productQuantity = $data['product_quantity'];
    }

    public function orderNumber(): string
    {
        return $this->orderNumber;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function deliveryPrice(): int
    {
        return $this->deliveryPrice;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function client(): string
    {
        return $this->client;
    }

    public function order(): string
    {
        return $this->order;
    }

    public function paymentMethod(): string
    {
        return $this->payment_method;
    }

    public function productId(): int
    {
        return $this->productId;
    }

    public function productQuantity(): int
    {
        return $this->productQuantity;
    }
}
