<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::withCount('orders')->orderBy('id', 'desc')->paginate(5);
        $this->authorize('viewAny', Client::class);
        return response()->view('dashboard.clients.index', compact('clients'));
    }
    public function indexClientHasOrders()
    {
        $clients = Client::withCount(['orders' => function (Builder $query) {
            $query->whereBetween('created_at', [(new Carbon())->yesterday()->hour(12)
                ,
                (new Carbon())->today()->hour(12)])
                ->where('status', 'waiting');}])
            ->orderBy('id', 'asc')->paginate(5);
        $this->authorize('viewAny', Client::class);
        return response()->view('dashboard.clients.indexClientHasOrder', compact('clients'));
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
        $this->authorize('create', Client::class);
        $roles = Role::where('guard_name', 'client')->get();

        return response()->view('dashboard.clients.create', compact('cities', 'roles'));
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
        $this->authorize('create', Client::class);

        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $clients = new Client();
            $clients->email = $request->get('email');
            $clients->password = Hash::make($request->get('password'));
            $isSaved = $clients->save();
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
                $roles = Role::findOrFail($request->get('role_id'));
                $clients->assignRole($roles);
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');

                $users->actor()->associate($clients);
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
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
        $this->authorize('view', Client::class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Client::class);
        //
        $roles = Role::where('guard_name', 'client')->get();
        $clients = Client::findOrFail($id);
        return response()->view('dashboard.clients.edit', compact('clients', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->authorize('update', Client::class);

        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $clients = Client::findOrFail($id);
            $clients->email = $request->get('email');
            $isSaved = $clients->save();
            if ($isSaved) {
                $users = $clients->user;
                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $roles = Role::findOrFail($request->get('role_id'));
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->actor()->associate($clients);
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('clients.index')];
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
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete', Client::class);

        $clients = Client::findOrFail($id);
        $users = $clients->user;
        $deleteUser = User::destroy($users->id);
        $deleteclient = Client::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $clients ? 200 : 400);
    }
}