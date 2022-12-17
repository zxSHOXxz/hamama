<?php

namespace App\Http\Controllers;

use App\Exports\OrderSearchedExport;
use App\Models\Captain;
use App\Models\city;
use App\Models\client;
use App\Models\Order;
use App\Models\sub_city;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportSearched(Request $request)
    {
        $query = Order::with(['captain', 'client', 'city', 'sub_city'])
            ->when($request->get('sub_city'), function ($query, $value) {
                $sub_city = sub_city::where('name', 'like', "%{$value}%")->first();
                $query->where('sub_city_id', $sub_city->id);
            })
            ->when($request->get('client_name'), function ($query, $value) {
                $userClient = User::where('name', 'like', "%{$value}%")->first();
                $query->where('client_id', '=', $userClient->actor_id);
            })
            ->when($request->get('captain_name'), function ($query, $value) {
                $userCaptain = User::where('name', 'like', "%{$value}%")->first();
                $query->where('captain_id', '=', $userCaptain->actor_id);
            })
            ->when($request->get('created_at'), function ($query, $value) {
                $query->where('created_at', '>=', $value);
            });

        $export = new OrderSearchedExport();
        $export->setQuery($query);
        return Excel::download($export, 'orders.xlsx');

    }

    public function index()
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::with(['captain', 'client', 'city', 'sub_city'])->whereDate('created_at', Carbon::today())->where('status', 'waiting')->orderBy('id', 'asc')->paginate(50);
        //
        return view('dashboard.orders.indexAll', compact('orders'));
    }
    public function archive(Request $request)
    {
        $this->authorize('viewAny', Order::class);
        //
        $orders = Order::with(['captain', 'client', 'city', 'sub_city'])->orderBy('id', 'asc');
        if ($request->get('sub_city')) {
            $sub_city = sub_city::where('name', $request->get('sub_city'))->first();
            $orders = $orders->where('sub_city_id', 'like', '%' . $sub_city->id . '%');
        }
        if ($request->get('client_name')) {
            $userClient = User::where('name', $request->get('client_name'))->first();
            $orders = $orders->where('client_id', 'like', '%' . $userClient->actor_id . '%');
        }
        if ($request->get('captain_name')) {
            $userCaptain = User::where('name', $request->get('captain_name'))->first();
            $orders = $orders->where('captain_id', 'like', '%' . $userCaptain->actor_id . '%');
        }
        if ($request->get('created_at')) {
            $orders = $orders->where('created_at', 'like', '%' . $request->created_at . '%');
        }
        $orders = $orders->paginate(50);
        return view('dashboard.orders.OrderArchive', compact('orders'));
    }
    public function indexOrders($id)
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::where('client_id', $id)->with(['captain', 'client'])->orderBy('created_at', 'asc')->paginate(50);
        return response()->view('dashboard.orders.index', compact('orders', 'id'));
    }
    public function createOrder($id)
    {
        $this->authorize('create', Order::class);

        $captains = Captain::all();
        $clients = client::all();
        $cities = city::all();
        return view('dashboard.orders.createInClient', compact('captains', 'clients', 'cities', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Order::class);
        //
        $captains = Captain::all();
        $clients = client::all();
        $cities = city::all();
        return view('dashboard.orders.create', compact('captains', 'clients', 'cities'));
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
        $this->authorize('create', Order::class);

        $validator = validator($request->all(), [

        ], [

        ]);

        if (!$validator->fails()) {
            $orders = new Order();
            $orders->customer = $request->get('customer');
            $orders->details = $request->get('details');
            $orders->status = 'waiting';
            $orders->price = $request->get('price');
            $orders->sub_city_id = $request->get('sub_city_id');
            $sub_city = sub_city::findOrFail($request->get('sub_city_id'));
            $orders->city_id = $sub_city->parent;
            $city = city::with('captain')->findOrFail($sub_city->parent);
            if ($request->get('captain_id') != null) {
                $orders->captain_id = $request->get('captain_id');
            } else {
                $orders->captain_id = $sub_city->captain->id;
            }
            $orders->statusDetails = 'قيد الارسال';
            $orders->client_id = $request->get('client_id');
            $isSaved = $orders->save();

            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => "تمت الإضافة بنجاح"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "فشلت عملية التخزين"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', Order::class);
        $order = Order::findOrFail($id);

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = Order::findOrFail($id);
        $cities = city::all();
        $captains = Captain::all();
        $this->authorize('update', Order::class);
        return view('dashboard.orders.edit', compact('order', 'cities', 'captains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->authorize('update', Order::class);

        $validator = validator($request->all(), [

        ], [

        ]);

        if (!$validator->fails()) {
            $orders = Order::findOrFail($id);
            $orders->customer = $request->get('customer');
            $orders->details = $request->get('details');
            $orders->status = $request->get('status');
            $orders->price = $request->get('price');
            $orders->sub_city_id = $request->get('sub_city_id');
            $sub_city = sub_city::findOrFail($request->get('sub_city_id'));
            $orders->city_id = $sub_city->parent;
            $city = city::with('captain')->findOrFail($sub_city->parent);
            if ($request->get('captain_id') != null) {
                $orders->captain_id = $request->get('captain_id');
            } else {
                $orders->captain_id = $sub_city->captain->id;
            }
            $orders->statusDetails = $request->get('statusDetails');
            $isSaved = $orders->save();
            return ['redirect' => route('orders.index')];
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => "تمت الإضافة بنجاح"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "فشلت عملية التخزين"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete', Order::class);

    }
}