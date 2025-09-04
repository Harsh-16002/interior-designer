<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriberModel;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        $subscription = SubscriberModel::create([
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing!'
        ]);
    }
}
