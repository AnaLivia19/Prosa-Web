<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user()->load('interesses', 'comunidades', 'eventos');

    return view('dashboard', compact('user'));
}
}
