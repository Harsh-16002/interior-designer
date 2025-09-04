<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TestimonialModel::all();
            return response()->json(['data' => $data]);
        }
        return view('admin.pages.testimonials');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'review' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $testimonial = new TestimonialModel();
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->review = $request->review;

        if ($request->hasFile('image')) {
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial created successfully',
            'data' => $testimonial
        ]);
    }

    public function edit($id)
    {
        $testimonial = TestimonialModel::findOrFail($id);
        return response()->json($testimonial);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'review' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $testimonial = TestimonialModel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->review = $request->review;
        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully',
            'data' => $testimonial
        ]);
    }

    public function destroy($id)
    {
        try {
            $testimonial = TestimonialModel::findOrFail($id);
            
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            
            $testimonial->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting testimonial: ' . $e->getMessage()
            ], 500);
        }
    }
}