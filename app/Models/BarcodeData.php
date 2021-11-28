<?php

namespace App\Models;

class BarcodeData
{
    private string $barcode;
    private string $description;

    public function __construct(string $barcode, string $description)
    {
        $this->barcode = $barcode;
        $this->description = $description;
    }

    public function barcode(): string
    {
        return $this->barcode;
    }

    public function description(): string
    {
        return $this->description;
    }
}
