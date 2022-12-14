<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use App\Models\city;
use App\Models\client;
use App\Models\Order;
use App\Models\sub_city;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('viewAny', Order::class);
        //
        $orders = Order::with(['captain', 'client', 'city'])->where('status', 'waiting')->orderBy('id', 'asc')->paginate(5);
        return view('dashboard.orders.indexAll', compact('orders'));
    }
    public function indexOrders($id)
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::where('client_id', $id)->with(['captain', 'client'])->orderBy('created_at', 'asc')->paginate(5);
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
        $this->authorize('update', Order::class);

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