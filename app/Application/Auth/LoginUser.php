<?php

namespace App\Application\Auth;

use Illuminate\Support\Facades\Auth;

class LoginUser
{
    public function execute(array $credentials, bool $remember = false): bool
    {
        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }
}
