<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private function buildProfileData(): array
    {
        $reviews = Review::query()->latest()->take(3)->get();
        $admin = Admin::query()->first();
        $stats = [
            'customers' => Order::count(),
            'orders' => OrderItem::count(),
            'rating' => Review::avg('rating'),
        ];

        return [
            'reviews' => $reviews,
            'admin' => $admin,
            'stats' => $stats,
            'shopName' => config('app.name'),
        ];
    }

    // Public (user) profile page
    public function index()
    {
        return view('pages.profile', $this->buildProfileData());
    }

    // Admin profile page
    public function admin()
    {
        return view('pages.admin.profile', $this->buildProfileData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        Review::create($validated);

        return redirect()->route('admin-profile.index')->with('status', 'Review added');
    }

    public function reviews()
    {
        $admin = Admin::query()->first();
        $reviews = Review::query()->latest()->paginate(10);
        return view('pages.reviews', compact('admin', 'reviews'));
    }
    
}
