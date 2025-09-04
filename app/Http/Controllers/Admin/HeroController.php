<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data= HeroModel::all();
            return response()->json(['data'=>$data]);
        }

        return view('admin.pages.hero');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'fblink' => 'nullable|url|max:255',
            'instralink' => 'nullable|url|max:255',
            'twitterlink' => 'nullable|url|max:255',
            'linkdinlink' => 'nullable|url|max:255',
            'slide_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hero = new HeroModel();
        $hero->heading = $request->heading;
        $hero->fblink = $request->fblink;
        $hero->instralink = $request->instralink;
        $hero->twitterlink = $request->twitterlink;
        $hero->linkdinlink = $request->linkdinlink;

        if ($request->hasFile('slide_image')) {
            $hero->slide_image = $request->file('slide_image')->store('uploads', 'public');
        }

        $hero->save();

        return response()->json(['message' => 'Hero created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hero = HeroModel::findOrFail($id);
        return response()->json($hero);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'fblink' => 'nullable|url|max:255',
            'instralink' => 'nullable|url|max:255',
            'twitterlink' => 'nullable|url|max:255',
            'linkdinlink' => 'nullable|url|max:255',
            'slide_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hero = HeroModel::findOrFail($id);

        if ($request->hasFile('slide_image')) {
            // Delete old image if exists
            if ($hero->slide_image && Storage::disk('public')->exists($hero->slide_image)) {
                Storage::disk('public')->delete($hero->slide_image);
            }

            $hero->slide_image = $request->file('slide_image')->store('uploads', 'public');
        }

        $hero->heading = $request->heading;
        $hero->fblink = $request->fblink;
        $hero->instralink = $request->instralink;
        $hero->twitterlink = $request->twitterlink;
        $hero->linkdinlink = $request->linkdinlink;
        $hero->save();

        return response()->json(['message' => 'Hero updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hero = HeroModel::findOrFail($id);

        if ($hero->slide_image && Storage::disk('public')->exists($hero->slide_image)) {
            Storage::disk('public')->delete($hero->slide_image);
        }

        $hero->delete();

        return response()->json(['message' => 'Hero deleted successfully']);
    }
}
