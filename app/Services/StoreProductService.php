<?php

namespace App\Services;

use App\Models\Barcode;
use App\Models\Product;
use App\Models\ProductData;
use Illuminate\Http\Request;

class StoreProductService
{
    public function execute(Request $request)
    {
        foreach ($request->products as $data) {
            $productData = new ProductData($data);

            $product = Product::create([
                'category' => $productData->category(),
                'title' => $productData->title(),
                'price' => $productData->price(),
                'discount' => $productData->discount(),
                'delivery_code' => $productData->deliveryCode(),
                'product_dimensions' => $productData->productDimensions(),
                'status' => $productData->status(),
                'quantity' => $productData->quantity(),
            ]);

            foreach ($productData->barcodes() as $barcode) {
                $barcode = (new Barcode([
                    'barcode' => $barcode->barcode(),
                    'description' => $barcode->description()
                ]));

                $barcode->product()->associate($product);
                $barcode->save();
            }
        }
    }
}
