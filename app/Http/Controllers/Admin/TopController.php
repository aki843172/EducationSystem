<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{

    function showTop(){
        if (Auth::check()) {
            $admins = Auth::all();
            return to_route('show.top', compact('admins'));
        }
        else
        {
            return view('login');
        }
    }
}
