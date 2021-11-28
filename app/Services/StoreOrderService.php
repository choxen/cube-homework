<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderData;
use Illuminate\Http\Request;

class StoreOrderService
{
    public function execute(Request $request)
    {
        foreach ($request->orders as $data) {
            $orderData = new OrderData($data);

            Order::create([
                'order_number' => $orderData->orderNumber(),
                'price' => $orderData->price(),
                'delivery_price' => $orderData->deliveryPrice(),
                'status' => $orderData->status(),
                'client' => $orderData->client(),
                'order' => $orderData->order(),
                'payment_method' => $orderData->paymentMethod(),
                'product_id' => $orderData->productId(),
                'product_quantity' => $orderData->productQuantity(),
            ]);
        }
    }
}
