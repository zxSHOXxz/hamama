<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use App\Models\city;
use App\Models\client;
use App\Models\orders;
use App\Models\Street;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = orders::with('city')->orderBy('id', 'asc')->paginate(5);
        return view('dashboard.orders.indexAll', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $captains = Captain::all();
        $clients = client::all();
        $streets = Street::all();
        $cities = city::all();
        return view('dashboard.orders.create', compact('captains', 'clients', 'streets', 'cities'));
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
        $validator = validator($request->all(), [
        ], [

        ]);

        if (!$validator->fails()) {
            $orders = new orders();
            $orders->customer = $request->get('customer');
            $orders->details = $request->get('details');
            $orders->status = $request->get('status');
            $orders->price = $request->get('price');
            $orders->statusDetails = $request->get('statusDetails');
            $orders->captain_id = $request->get('captain_id');
            $orders->client_id = $request->get('client_id');
            $orders->street_id = $request->get('street_id');
            $orders->city_id = $request->get('city_id');
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
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }
}