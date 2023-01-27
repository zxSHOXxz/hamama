<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Envelope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EnvelopesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Envelope::class);
        $envelopes = Envelope::with('client')->orderBy('id', 'desc')->paginate(50);
        return view('dashboard.envelopes.indexAll', compact('envelopes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Envelope::class);
        $clients = Client::paginate(50);
        return view('dashboard.envelopes.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Envelope::class);
        $validator = validator($request->all(),
            [
                'details' => 'required|string',
            ], [
                'details.required' => 'القيمة مطلوبة',
            ]);
        if (!$validator->fails()) {
            $envelope = new Envelope();
            $envelope->details = $request->get('details');
            $envelope->client_id = $request->get('client_id');
            $isSaved = $envelope->save();
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
     * @param  \App\Models\Envelope  $envelopes
     * @return \Illuminate\Http\Response
     */
    public function show(Envelope $envelopes)
    {
        $this->authorize('show', Envelope::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Envelope  $envelop
     * @return \Illuminate\Http\Response
     */
    public function edit(Envelope $envelop)
    {
        $this->authorize('update', Envelope::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Envelop  $envelop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envelope $envelop)
    {
        $this->authorize('update', Envelope::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $envelope = Envelope::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $envelope ? 200 : 400);
    }
}