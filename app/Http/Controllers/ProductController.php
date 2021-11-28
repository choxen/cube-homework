<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\AddProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request, AddProductService $service)
    {
        $this->validate($request, [
            'products' => 'required|array|min:1',
            'products.*.category' => 'required',
            'products.*.title' => 'required',
            'products.*.price' => 'required',
            'products.*.discount' => 'required',
            'products.*.delivery_code' => 'required',
            'products.*.product_dimensions' => 'required',
            'products.*.status' => 'required',
            'products.*.quantity' => 'required',
            'products.*.barcodes' => 'required|array',
            'products.*.barcodes.*.barcode' => 'required',
            'products.*.barcodes.*.description' => 'required',
        ]);

        $service->execute($request);

        return response()->json([
            'message' => 'Product was added successfully'
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $productId = $request->get('product_id');

        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product with ID: ' . $productId . ' does not exist.'
            ]);
        }

        return response()->json([
            $product
        ]);
    }
}
