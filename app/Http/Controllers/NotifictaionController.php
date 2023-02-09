<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotifictaionController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->get();
        return view('dashboard.notifications.index', compact('notifications'));
    }
}
