<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\UserPresenceLog;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $customers = Customer::query();

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $customers->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $customers->where('is_active', false);
            }
        }

        $customers = $customers->paginate(15);
        $totalCustomers = Customer::count();

        $onlineCustomerIds = UserPresenceLog::where('user_type', 'customer')
            ->where('is_online', true)
            ->pluck('user_id')
            ->map(fn($id) => (int) $id)
            ->toArray();

        return view('admin.customers.index', [
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'onlineCustomerIds' => $onlineCustomerIds,
        ]);
    }
}
