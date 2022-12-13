<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use App\Models\city;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $captains = Captain::orderBy('id', 'desc')->paginate(5);
        $this->authorize('viewAny', Captain::class);
        return response()->view('dashboard.captain.index', compact('captains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = city::all();
        $this->authorize('create', Captain::class);
        return response()->view('dashboard.captain.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', Captain::class);

        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $captains = new Captain();
            $captains->email = $request->get('email');
            $captains->password = Hash::make($request->get('password'));
            $isSaved = $captains->save();
            if ($isSaved) {
                $users = new User();

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                }

                $users->name = $request->get('first_name') . " " . $request->get('last_name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');

                $users->actor()->associate($captains);
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
     * @param  \App\Models\Captain  $Captain
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', Captain::class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Captain  $Captain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $captains = Captain::findOrFail($id);
        $this->authorize('update', Captain::class);
        return response()->view('dashboard.captain.edit', compact('captains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Captain  $Captain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->authorize('update', Captain::class);
        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $captains = Captain::findOrFail($id);
            $captains->email = $request->get('email');
            $isSaved = $captains->save();
            if ($isSaved) {
                $users = $captains->user;
                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->actor()->associate($captains);
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('captains.index')];
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
     * @param  \App\Models\Captain  $Captain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete', Captain::class);

        $captains = Captain::findOrFail($id);
        $users = $captains->user;
        $deleteUser = User::destroy($users->id);
        $deleteCaptain = Captain::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $captains ? 200 : 400);
    }
}