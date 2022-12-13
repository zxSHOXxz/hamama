<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::orderBy('id', 'desc')->paginate(5);
        $this->authorize('viewAny', Admin::class);
        return response()->view('dashboard.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        $roles = Role::where('guard_name', 'admin')->get();
        $this->authorize('create', Admin::class);
        return response()->view('dashboard.admin.create', compact('cities', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);
        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if ($isSaved) {
                $users = new User();

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                }
                $roles = Role::findOrFail($request->get('role_id'));
                $admins->assignRole($roles);
                $users->name = $request->get('first_name') . " " . $request->get('last_name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');

                $users->actor()->associate($admins);
                $isSaved = $users->save();

                return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية الاضافة '], 400);
            }

        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
        $this->authorize('view', Admin::class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admins = Admin::findOrFail($id);
        $this->authorize('update', Admin::class);

        return response()->view('dashboard.admin.edit', compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Admin::class);

        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isSaved = $admins->save();
            if ($isSaved) {
                $users = $admins->user;
                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->actor()->associate($admins);
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('admins.index')];
                }
                return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية الاضافة '], 400);
            }

        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //
        $this->authorize('delete', Admin::class);
        $admins = Admin::findOrFail($id);
        $users = $admins->user;
        $deleteUser = User::destroy($users->id);
        $deleteAdmin = Admin::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $admins ? 200 : 400);
    }
}