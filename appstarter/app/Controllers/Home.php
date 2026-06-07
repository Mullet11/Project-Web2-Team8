<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }


    public function dashboard(): string
    {
        return view('user/dashboard');
    }
}