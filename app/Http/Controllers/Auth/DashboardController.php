<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Đảm bảo bạn có file view 'resources/views/dashboard.blade.php'
    }
}