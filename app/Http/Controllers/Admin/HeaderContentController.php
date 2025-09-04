<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderModel;

class HeaderContentController extends Controller
{
    public function index()
    {
        $header = HeaderModel::firstOrNew();
        return view('admin.pages.header', compact('header'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $header = HeaderModel::findOrFail($id);

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('uploads', 'public');
            $header->logo = $imagePath;
        }

        $header->text = $request->text;
        $header->save();

        return redirect()->back()->with('success', 'Header updated successfully');
    }

    public function show(string $id)
    {
        $header = HeaderModel::first();
        return view('user.index', compact('header'));
    }
}