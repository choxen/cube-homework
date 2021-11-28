<?php

namespace App\Models;

class ProductData
{
    private string $category;
    private string $title;
    private int $price;
    private int $discount;
    private string $deliveryCode;
    private string $productDimensions;
    private string $status;
    private int $quantity;
    private array $barcodes;

    public function __construct(array $data)
    {
        $this->category = $data['category'];
        $this->title = $data['title'];
        $this->price = (int)$data['price'];
        $this->discount = (int)$data['discount'];
        $this->deliveryCode = $data['delivery_code'];
        $this->productDimensions = $data['product_dimensions'];
        $this->status = $data['status'];
        $this->quantity = (int)$data['quantity'];

        foreach ($data['barcodes'] as $barcode) {
            $this->addBarcode(
                new BarcodeData($barcode['barcode'], $barcode['description'])
            );
        }
    }

    public function addBarcode(BarcodeData $barcode)
    {
        $this->barcodes[] = $barcode;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function discount(): int
    {
        return $this->discount;
    }

    public function deliveryCode(): string
    {
        return $this->deliveryCode;
    }

    public function productDimensions(): string
    {
        return $this->productDimensions;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function barcodes(): array
    {
        return $this->barcodes;
    }
}
