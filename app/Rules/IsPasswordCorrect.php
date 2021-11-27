<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class IsPasswordCorrect implements Rule
{

    private ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value): bool
    {
        if (Hash::check($value, $this->user->password)) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'Entered password is incorrect.';
    }
}
