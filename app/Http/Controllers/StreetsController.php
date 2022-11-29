<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;

class StreetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $streets = Street::orderBy('id', 'desc')->paginate(5);
        return view('dashboard.street.index', compact('streets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.street.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(),
            [
                'name' => 'required|string|min:3|max:20',
            ], [
                'name.required' => 'الإسم مطلوب',
                'name.min' => 'لا يقبل أقل من 3 حروف',
                'name.max' => 'لا يقبل أكثر من 20 حروف',
            ]);
            if (! $validator->fails()) {
                $street = new Street();
                $street->name = $request->get('name');
                $street->details = $request->get('details');
                $isSaved =  $street->save();
                if($isSaved){
                    return response()->json(['icon' => 'success' , 'title' => "تمت الإضافة بنجاح"] , 200);
                }else{
                    return response()->json(['icon' => 'error' , 'title' => "لم تتم عملية الاضافة"] , 400);
                }
            }
            else {
                return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] , 400);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $streets = Street::findOrFail($id);
        return response()->view('dashboard.street.edit' , compact('streets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all() , [
            'name' => 'required',
        ]);

        if(! $validator->fails()){
            $street = Street::findOrFail($id);
            $street->name = $request->get('name');
            // $street->details = $request->get('details');
            $isUpdate = $street->save();

            return ['redirect' =>route('streets.index')];

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
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        //
    }
}
