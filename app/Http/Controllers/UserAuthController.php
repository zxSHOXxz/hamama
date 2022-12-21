<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLogin($guard)
    {
        return response()->view('dashboard.auth.login', compact('guard'));
    }
    function list() {
        return response()->view('dashboard.auth.list');
    }

    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.exists' => 'الايميل غير موجود',
        ]);

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                return response()->json(['icon' => 'success', 'title' => "تم تسجيل الدخول"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "فشلت عملية تسجيل الدخول"], 400);

            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

    }

    public function logout(Request $request)
    {
        // Auth::guard()->logout();
        // $request->session()->invalidate();
        // return redirect()->route('view.login' , 'admin');

        $guard = auth('admin')->check() ? 'admin' : 'client';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('frontView', $guard);
    }

    public function create_account()
    {
        return view('dashboard.auth.sign-up');
    }
}
