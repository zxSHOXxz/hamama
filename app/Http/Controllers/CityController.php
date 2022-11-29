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
        $cities = City::orderBy('id' , 'desc')->paginate(5);
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
        $validator = validator($request->all() , [
            'name' => 'required|string|min:3|max:20',
        ] , [
            'name.required' => 'الإسم مطلوب' ,
            'name.min' => 'لا يقبل أقل من 3 حروف' ,
            'name.max' => 'لا يقبل أكثر من 20 حروف'
        ]);

        if(! $validator->fails()){
            $cities = new City();
            $cities->name = $request->get('name');
            $isSaved = $cities->save();

            if($isSaved){
                return response()->json(['icon' => 'success' , 'title' => "تمت الإضافة بنجاح"] , 200);
            }
            else{
                return response()->json(['icon' => 'error' , 'title' => "فشلت عملية التخزين"], 400);
            }
        }
        else {
            return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] , 400);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::findOrFail($id);
        return response()->view('dashboard.city.edit' , compact('cities'));
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
        $validator = validator($request->all() , [
            'name' => 'required',
        ]);

        if(! $validator->fails()){

            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $isUpdate = $cities->save();

            return ['redirect' =>route('cities.index')];

            if($isUpdate){
                return response()->json(['icon' => 'success' , 'title' => "تمت عملية التعديل بنجاح"] , 200);
            }
            else{
                return response()->json(['icon' => 'error' , 'title' => "فشلت عملية التعديل "] , 400);

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] , 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        //
    }
}