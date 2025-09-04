<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUsModel;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whyUs = WhyUsModel::first();
        return view('admin.pages.why-us',compact('whyUs'));
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
  public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'heading' => 'required|string|',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $whyUs = WhyUsModel::findOrFail($id);

        if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $whyUs->image = $imagePath;
      
    }

    $whyUs->title = $request->title;
    $whyUs->main_heading = $request->heading;
    $whyUs->save();
    
    return redirect()->back()->with('success', 'Why Us section updated successfully');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
