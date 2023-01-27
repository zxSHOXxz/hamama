<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $orders = Order::with(['captain', 'client', 'city', 'sub_city'])->whereBetween(
            'created_at',
            [
                (new Carbon())->yesterday()->hour(14),
                (new Carbon())->today()->hour(12)->minute(10)
            ]
        )
            ->withCount('client')
            ->where('status', 'waiting')
            ->orderBy('id', 'asc')->paginate(5);
        $clients = Client::withCount(['orders' => function (Builder $query) {
            $query->whereBetween('created_at', [
                (new Carbon())->yesterday()->hour(14),
                (new Carbon())->today()->hour(12)->minute(10)
            ]);
        }])
            ->orderBy('id', 'asc')->paginate(5);
        $newClients = Client::whereBetween('created_at', [
            (new Carbon())->today()->startOfDay(14),
            (new Carbon())->today()->now()
        ])->orderBy('id', 'asc')->get();
        return view('dashboard.dashboard', compact('orders', 'clients', 'newClients'));
    }

    public function resendEmail(){
        $user = UserVerify::where('user_id', Auth::user()->id)->first();
        $users = User::findOrFail(Auth::user()->id);
        $client = Client::findOrFail($users->actor_id);
        $token = $user->token;
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function ($message) use ($client) {
            $message->to($client->email);
            $message->subject('Email Verification Mail');
        });
        return response()->view('dashboard.auth.verification');
    }
    public function editProfile()
    {
        $clients = Auth::guard('admin')->check() ? Admin::findOrFail(Auth::user()->id) : Client::findOrFail(Auth::user()->id);
        return response()->view('dashboard.clients.editProfile', compact('clients'));
    }
    public function editPassword()
    {
        return response()->view('dashboard.clients.editPassword');
    }
    public function updateProfile(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email',
            'image' => "nullable|max:2048",
        ]);
        if (!$validator->fails()) {
            $clients = Auth::guard('admin')->check() ? Admin::findOrFail(Auth::user()->id) : Client::findOrFail(Auth::user()->id);
            $clients->email = $request->get('email');
            $isSaved = $clients->save();
            if ($isSaved) {
                $users = $clients->user;

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                }

                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('editProfile')];
                }
                return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية الاضافة '], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function updatePassword(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'client';
        $validator = Validator($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
            'new_password_confirmation' => 'required|string'
        ]);
        if (!$validator->fails()) {
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => 'تم تغيير كلمة المرور بنجاح'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية تغيير كلمة المرور'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
}