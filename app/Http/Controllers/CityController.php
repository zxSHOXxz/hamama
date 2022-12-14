<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $this->authorize('viewAny', city::class);
        $cities = City::withCount('sub_cities')->orderBy('id', 'asc')->get();
        return view('dashboard.city.index', compact('cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', city::class);
        return view('dashboard.city.create');

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
        $this->authorize('create', city::class);

        $validator = validator($request->all(), [
            'name' => 'required|string|min:3|max:20',
        ], [
            'name.required' => 'الإسم مطلوب',
            'name.min' => 'لا يقبل أقل من 3 حروف',
            'name.max' => 'لا يقبل أكثر من 20 حروف',
        ]);

        if (!$validator->fails()) {
            $cities = new City();
            $cities->name = $request->get('name');
            // $cities->c_id = $request->get('c_id');
            $isSaved = $cities->save();

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
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        //
        $this->authorize('view', city::class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', city::class);

        $cities = City::findOrFail($id);
        return response()->view('dashboard.city.edit', compact('cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', city::class);

        $validator = validator($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {

            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $isUpdate = $cities->save();
            return ['redirect' => route('cities.index')];

            if ($isUpdate) {
                return response()->json(['icon' => 'success', 'title' => "تمت عملية التعديل بنجاح"], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => "فشلت عملية التعديل "], 400);

            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', city::class);

        $cities = City::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $cities ? 200 : 400);

    }
}