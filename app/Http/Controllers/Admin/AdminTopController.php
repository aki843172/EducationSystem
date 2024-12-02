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
            return route('admin.top', compact('admins'));
        }
        else
        {
            return route('admin.login');
        }
    }
}
