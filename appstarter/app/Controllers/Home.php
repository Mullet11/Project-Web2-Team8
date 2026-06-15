<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }

    public function signup(): string
    {
        return view('auth/signup');
    }

    public function dashboard(): string
    {
        return view('user/dashboard');
    }

    public function slot(): string
    {
        return view('user/slot');
    }

    public function history(): string
    {
        return view('user/history');
    }

    public function profil(): string
    {
        return view('user/profil');
    }
}