<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TeamModel::all();
            return response()->json(['data' => $data]);
        }
        return view('admin.pages.team');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $team = new TeamModel();
        $team->name = $request->name;
        $team->position = $request->position;
        $team->bio = $request->bio;
        $team->facebook = $request->facebook;
        $team->instagram = $request->instagram;
        $team->twitter = $request->twitter;

        if ($request->hasFile('image')) {
            $team->image = $request->file('image')->store('team', 'public');
        }

        $team->save();

        return response()->json([
            'success' => true,
            'message' => 'Team member created successfully',
            'data' => $team
        ]);
    }

    public function edit($id)
    {
        $team = TeamModel::findOrFail($id);
        return response()->json($team);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $team = TeamModel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            $team->image = $request->file('image')->store('team', 'public');
        }

        $team->name = $request->name;
        $team->position = $request->position;
        $team->bio = $request->bio;
        $team->facebook = $request->facebook;
        $team->instagram = $request->instagram;
        $team->twitter = $request->twitter;
        $team->save();

        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully',
            'data' => $team
        ]);
    }

    public function destroy($id)
    {
        try {
            $team = TeamModel::findOrFail($id);
            
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            
            $team->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Team member deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting team member: ' . $e->getMessage()
            ], 500);
        }
    }
}