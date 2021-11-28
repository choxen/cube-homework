<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MakeOrderService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, MakeOrderService $service): JsonResponse
    {
        $this->validate($request, [
            'orders' => 'required|array',
            'orders.*.order_number' => 'required',
            'orders.*.price' => 'required',
            'orders.*.delivery_price' => 'required',
            'orders.*.status' => 'required',
            'orders.*.client' => 'required',
            'orders.*.client.*.name' => 'required',
            'orders.*.client.*.lastname' => 'required',
            'orders.*.client.*.phone_number' => 'required',
            'orders.*.order' => 'required',
            'orders.*.order.*.delivery_type' => 'required',
            'orders.*.order.*.address' => 'required',
            'orders.*.payment_method' => 'required',
            'orders.*.payment_method.*.method' => 'required',
            'orders.*.payment_method.*.status' => 'required',
            'orders.*.product_id' => 'required',
            'orders.*.product_quantity' => 'required',
        ]);

        $service->execute($request);

        return response()->json([
            'message' => 'Order has been made successfully'
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|string'
        ]);

        $dateString = $request->get('date');

        $date = Carbon::parse($dateString);
        $tomorrow = Carbon::parse($dateString)->addDay();

        $orders = Order::whereBetween('updated_at', [$date->toDateString(), $tomorrow])->get();

        return response()->json([
            $orders
        ]);
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required'
        ]);

        $orderId = $request->get('order_id');
        $status = $request->get('status');
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'message' => 'Order with this ID does not exist'
            ]);
        }

        $order->status = $status;
        $order->save();

        return response()->json([
            'message' => 'Order status with ID: ' . $orderId . ' has been updated successfully'
        ]);
    }
}
