<x-admin.layouts.app :title="'Admin Dashboard'">
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div>
        <div class="content-card">
            <h3>Welcome to Admin Dashboard</h3>
            <p style="color: #718096; line-height: 1.6;">
                Welcome back, <strong>{{ Auth::guard('admin')->user()->name }}</strong>!
                Use the sidebar navigation to manage products, view reports, and configure system settings.
            </p>
        </div>
    </div>
    <div class="stats shadow mt-6">
        <x-admin.dashboard.stats-card title="Total Products" :value="$totalProducts ?? 0" />
    </div>

</x-admin.layouts.app>
