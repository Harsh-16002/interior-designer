<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutModel::first();
        return view('admin.pages.about',compact('about'));
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
            'main_heading' => 'required|string|max:255',
            'para1' => 'nullable',
            'para2' => 'nullable',
            'title' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $about = AboutModel::findOrFail($id);

          if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $about->image = $imagePath;
    }

       $about->title = $request->title;
       $about->main_heading = $request->main_heading;
       $about->para1 = $request->para1;
       $about->para2 = $request->para2;
       $about->save();
       
    return redirect()->back()->with('success', 'Header updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
