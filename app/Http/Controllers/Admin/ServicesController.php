<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServicesModel::all();
            return response()->json(['data' => $data]);
        }
        return view('admin.pages.services');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $services = new ServicesModel();
        $services->title = $request->title;
        $services->description = $request->description;

        if ($request->hasFile('image')) {
            $services->image = $request->file('image')->store('projects', 'public');
        }

        $services->save();

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'data' => $services
        ]);
    }

    public function edit($id)
    {
        $project = ServicesModel::findOrFail($id);
        return response()->json($project);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $services = ServicesModel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($services->image && Storage::disk('public')->exists($services->image)) {
                Storage::disk('public')->delete($services->image);
            }
            $services->image = $request->file('image')->store('projects', 'public');
        }

        $services->title = $request->title;
        $services->description = $request->description;
        $services->save();

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'data' => $services
        ]);
    }

    public function destroy($id)
    {
        try {
            $services = ServicesModel::findOrFail($id);
            
            if ($services->image && Storage::disk('public')->exists($services->image)) {
                Storage::disk('public')->delete($services->image);
            }
            
            $services->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting project: ' . $e->getMessage()
            ], 500);
        }
    }
}