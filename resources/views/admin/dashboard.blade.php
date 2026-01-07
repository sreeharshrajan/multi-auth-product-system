<x-admin.layouts.app :title="'Admin Dashboard'">
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div>
        <div class="content-card">
            <h3> Welcome back, <strong>{{ Auth::guard('admin')->user()->name }}</strong>!</h3>
        </div>
    </div>
    
    <div class="stats shadow mt-6">
        <x-admin.dashboard.stats-card title="Total Products" :value="$totalProducts ?? 0" />
    </div>

</x-admin.layouts.app>
