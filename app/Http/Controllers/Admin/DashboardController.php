<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriberModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentSubscribers = SubscriberModel::orderBy('created_at','desc')->take(5)->get();
        $newSubscribersCount = SubscriberModel::where('seen', false)->count();

        return view('admin.dashboard', compact('recentSubscribers','newSubscribersCount'));
    }

    public function getNewSubscribers()
    {
        $subscribers = SubscriberModel::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'email' => $item->email,
                'time' => $item->created_at->diffForHumans()
            ]);

        $count = SubscriberModel::where('seen', false)->count();

        return response()->json([
            'count' => $count,
            'subscribers' => $subscribers
        ]);
    }

    public function getAllSubscribers()
    {
        $subscribers = SubscriberModel::orderBy('created_at', 'desc')
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'email' => $item->email,
                'time' => $item->created_at->format('M d, Y H:i')
            ]);

        return response()->json($subscribers);
    }

    public function deleteSubscriber($id)
    {
        SubscriberModel::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function markSeen()
    {
        SubscriberModel::where('seen', false)->update(['seen' => true]);
        return response()->json(['success' => true]);
    }
}
