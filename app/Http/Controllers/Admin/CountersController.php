<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounterModel;
use Illuminate\Http\Request;

class CountersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counter = CounterModel::first();
        return view('admin.pages.counter',compact('counter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $request->validate([
            'projects' => 'required|integer',
            'clients'  => 'required|integer',
            'awards'   => 'required|integer',
            'coffee'   => 'required|integer',
        ]);

        $counter = CounterModel::findOrFail($id);
        $counter->projects_completed = $request->projects;
        $counter->happy_clients = $request->clients;
        $counter->awards_received = $request->awards;
        $counter->cup_of_coffee = $request->coffee;
        $counter->save();

        return response()->json([
            'success' => true,
            'data' => $counter
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
