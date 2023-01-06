<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;

class ProviderHomeController extends Controller
{
    public function index()
    {
        return view('provider.home');
    }
}
