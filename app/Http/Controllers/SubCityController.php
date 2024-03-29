<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Sub_City;
use Illuminate\Http\Request;

class SubCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubCities($id)
    {
        $this->authorize('viewAny', Sub_City::class);

        $sub_cities = Sub_City::where('city_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('dashboard.sub_city.index', compact('sub_cities', 'id'));
    }
    public function createSub_city($id)
    {
        $this->authorize('create', Sub_City::class);

        $cities = City::all();
        return response()->view('dashboard.sub_city.createInCity', compact('id', 'cities'));
    }
    public function index()
    {
        $this->authorize('viewAny', sub_city::class);
        $sub_cities = sub_city::orderBy('id', 'desc')->paginate(5);
        return view('dashboard.sub_city.indexAll', compact('sub_cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Sub_City::class);
        $cities = City::all();
        return view('dashboard.sub_city.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', sub_city::class);

        $validator = validator($request->all(), [
            'name' => 'required|string|min:3|max:20',
        ], [
            'name.required' => 'الإسم مطلوب',
            'name.min' => 'لا يقبل أقل من 3 حروف',
            'name.max' => 'لا يقبل أكثر من 20 حروف',
        ]);

        if (!$validator->fails()) {
            $sub_cities = new sub_city();
            $sub_cities->name = $request->get('name');
            $sub_cities->city_id = $request->get('city_id');
            $sub_cities->parent = $request->get('city_id');
            $isSaved = $sub_cities->save();

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
     * @param  \App\Models\sub_city  $sub_city
     * @return \Illuminate\Http\Response
     */
    public function show(sub_city $sub_city)
    {
        $this->authorize('view', Sub_City::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sub_city  $sub_city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Sub_City::class);

        $sub_city = Sub_City::findOrFail($id);
        $cities = City::all();
        return response()->view('dashboard.sub_city.edit', compact('cities', 'sub_city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sub_city  $sub_city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Sub_City::class);

        $validator = validator($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {

            $sub_cities = sub_city::findOrFail($id);
            $sub_cities->name = $request->get('name');
            $sub_cities->city_id = $request->get('city_id');
            $sub_cities->parent = $request->get('city_id');
            $isUpdate = $sub_cities->save();

            return ['redirect' => route('sub_cities.index')];

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
     * @param  \App\Models\sub_city  $sub_city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', sub_city::class);

        $sub_cities = sub_city::destroy($id);
    }
}