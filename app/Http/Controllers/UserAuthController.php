<?php

namespace App\Http\Controllers;

use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLogin($guard)
    {
        return response()->view('dashboard.auth.login', compact('guard'));
    }
    function list()
    {
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

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('view.login', 'client')->with('message', $message);
    }
    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'client';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('frontView', $guard);
    }

    public function create_account()
    {
        return view('dashboard.auth.login');
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard.master');
        }

        return redirect("view.login")->withSuccess('Opps! You do not have access');
    }
}