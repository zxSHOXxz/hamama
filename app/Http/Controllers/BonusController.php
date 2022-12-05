<?php

namespace App\Http\Controllers;

use App\Models\bonus;
use App\Models\city;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bonuses = bonus::with('city')->orderBy('id', 'desc')->paginate(5);
        return view('dashboard.bonus.indexAll', compact('bonuses'));
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
        return view('dashboard.bonus.create', compact('cities'));

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
        $validator = validator($request->all(),
            [
                'price' => 'required|string',
            ], [
                'price.required' => 'القيمة مطلوبة',
            ]);
        if (!$validator->fails()) {
            $bonus = new bonus();
            $bonus->price = $request->get('price');
            $bonus->city_id = $request->get('city_id');
            $isSaved = $bonus->save();
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => "تمت الإضافة بنجاح"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "لم تتم عملية الاضافة"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show(bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $bonuses = bonus::findOrFail($id);
        $cities = city::all();
        return view('dashboard.bonus.edit', compact('cities', 'bonuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = validator($request->all(),
            [
                'price' => 'required|string',
            ], [
                'price.required' => 'القيمة مطلوبة',
            ]);
        if (!$validator->fails()) {
            $bonus = bonus::with('city')->findOrFail($id);
            $bonus->price = $request->get('price');
            $bonus->city_id = $request->get('city_id');
            $isSaved = $bonus->save();
            return ['redirect' => route('bonuses.index')];
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => "تمت الإضافة بنجاح"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "لم تتم عملية الاضافة"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bonus = bonus::destroy($id);
    }
}