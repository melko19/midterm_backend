<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function show(Instrument $instrument) {
        return response()->json($instrument,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $instrument = Instrument::where('name','like',"%$request->key%")
            ->orWhere('definition','like',"%$request->key%")->get();

        return response()->json($instruments, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'definition' => 'string|required',
            'type' => 'string|required',
            'contained_in' => 'numeric',
            'price' => 'numeric|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $instrument = Instrument::create($request->all());
            return response()->json($instrument, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Instrument $instrument) {
        try {
            $instrument->update($request->all());
            return response()->json($instrument, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Instrument $instrument) {
        $instrument->delete();
        return response()->json(['message'=>'Instrument deleted.'],202);
    }

    public function index() {
        $instruments = Instrument::orderBy('name')->get();
        return response()->json($instruments, 200);
    }
}
