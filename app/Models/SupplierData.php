<?php

namespace App\Models;

class SupplierData
{
    private string $deliveryCode;
    private string $title;
    private string $address;
    private string $city;
    private string $fullName;
    private string $phoneNumber;

    public function __construct(array $data)
    {
        $this->deliveryCode = $data['delivery_code'];
        $this->title = $data['title'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->fullName = $data['full_name'];
        $this->phoneNumber = $data['phone_number'];
    }

    public function deliveryCode(): string
    {
        return $this->deliveryCode;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function city(): string
    {
        return $this->city;
    }


    public function fullName(): string
    {
        return $this->fullName;
    }

    public function phoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
