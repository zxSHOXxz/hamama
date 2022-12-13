<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Street;
use Illuminate\Http\Request;

class StreetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStreets($id)
    {
        $this->authorize('viewAny', Street::class);
        $streets = Street::where('city_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('dashboard.street.index', compact('streets', 'id'));
    }
    public function createStreets($id)
    {
        $this->authorize('create', Street::class);
        $cities = city::all();
        return response()->view('dashboard.street.createInCity', compact('id', 'cities'));
    }
    public function index()
    {
        $this->authorize('viewAny', Street::class);

        //
        $streets = Street::with('city')->orderBy('id', 'desc')->paginate(5);
        return view('dashboard.street.indexAll', compact('streets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('create', Street::class);
        //
        $cities = city::all();
        return view('dashboard.street.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Street::class);

        $validator = validator($request->all(),
            [
                'name' => 'required|string|min:3|max:20',
            ], [
                'name.required' => 'الإسم مطلوب',
                'name.min' => 'لا يقبل أقل من 3 حروف',
                'name.max' => 'لا يقبل أكثر من 20 حروف',
            ]);
        if (!$validator->fails()) {
            $street = new Street();
            $street->name = $request->get('name');
            $street->details = $request->get('details');
            $street->city_id = $request->get('city_id');
            $isSaved = $street->save();
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
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        $this->authorize('view', Street::class);

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
        $this->authorize('update', Street::class);

        $streets = Street::with('city')->findOrFail($id);
        $cities = city::all();
        return response()->view('dashboard.street.edit', compact('streets', 'cities'));
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
        $this->authorize('update', Street::class);

        $validator = validator($request->all(), [
            'name' => 'required',
        ]);
        if (!$validator->fails()) {
            $street = Street::with('city')->findOrFail($id);
            $street->name = $request->get('name');
            $street->details = $request->get('details');
            $street->city_id = $request->get('city_id');
            $isUpdate = $street->save();
            return ['redirect' => route('streets.index')];
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
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Street::class);

        $street = Street::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $street ? 200 : 400);
    }
}