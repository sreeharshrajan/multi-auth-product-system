<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalCustomers = Customer::count();
        $totalRevenue = 0; // This can be calculated from orders when implemented

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalCustomers',
            'totalRevenue'
        ));
    }
}
