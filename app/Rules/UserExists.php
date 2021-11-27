<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserExists implements Rule
{
    private ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value): bool
    {
        if ($this->user) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'User with this email address does not exist.';
    }
}
