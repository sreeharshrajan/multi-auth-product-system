<x-customer.layouts.app :title="'Customer Dashboard'">
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::guard('customer')->user()->name }}!</h1>
        <p class="mb-2">This is your customer dashboard.</p>
    </div>
</x-customer.layouts.app>
