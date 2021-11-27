<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use TheSeer\Tokenizer\Token;

class IsAlreadyLoggedIn implements Rule
{
    private ?User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        if (!$this->user->tokens()) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'This user is already logged in.';
    }
}
