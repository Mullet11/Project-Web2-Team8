<?php

namespace App\Application\Auth;

use Illuminate\Support\Facades\Auth;

class LoginUser
{
    /**
     * Mengeksekusi proses login berdasarkan data request
     *
     * @param array $credentials
     * @param bool $remember
     * @return bool
     */
    public function execute(array $credentials, bool $remember = false): bool
    {
        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }
}
