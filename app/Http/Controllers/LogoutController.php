<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class LogoutController extends Controller
{
    public function logout()
    {
        // Flush all session data
       session()->flush();
        return view('logout');
    }
}
