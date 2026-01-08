<x-admin.layouts.app :title="'Customer Management'">
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Customers</h2>
            </div>
        </div>
    </x-slot>

    <div class="card bg-base-100 border border-base-200 shadow-sm">
        {{-- Header --}}
        <div
            class="p-4 border-b border-base-200 flex flex-col sm:flex-row justify-between items-center gap-4 bg-base-50/50">
            <div class="flex items-center gap-2">
                <span class="text-sm font-black uppercase tracking-widest opacity-70">
                    {{ $totalCustomers }} total customers
                </span>
                <div class="badge badge-outline gap-2 font-bold text-[10px]">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-success"></span>
                    </span>
                    <span id="online-count">0</span> ONLINE NOW
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-base-200/50">
                    <tr>
                        <th class="text-[10px] uppercase tracking-widest font-bold">Name</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold">Email</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold text-center">Presence</th>
                    </tr>
                </thead>
                <tbody id="customers-table-body">
                    @forelse ($customers as $customer)
                        <tr data-customer-id="{{ $customer->id }}" class="hover:bg-base-200/30 transition-colors">
                            <td>{{ $customer->name ?? 'N/A' }}</td>
                            <td>{{ $customer->email ?? 'N/A' }}</td>
                            <td class="text-center presence-cell">
                                <span
                                    class="badge badge-ghost badge-sm opacity-30 text-[10px] font-black italic">OFFLINE</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-10">No customers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.INITIAL_ONLINE_CUSTOMERS = @json($onlineCustomerIds);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const onlineUsers = new Set();
            const onlineCountEl = document.getElementById('online-count');

            function updateCount() {
                onlineCountEl.textContent = onlineUsers.size;
            }

            function updateTable() {
                document.querySelectorAll('tr[data-customer-id]').forEach(row => {
                    const id = Number(row.dataset.customerId);
                    const cell = row.querySelector('.presence-cell');

                    if (onlineUsers.has(id)) {
                        cell.innerHTML = `
                    <div class="badge badge-success gap-1.5 text-[10px] font-bold uppercase">
                        <span class="h-1.5 w-1.5 rounded-full bg-white animate-pulse"></span>
                        Online
                    </div>
                `;
                    } else {
                        cell.innerHTML = `
                    <span class="badge badge-ghost badge-sm opacity-30 text-[10px] font-black italic">
                        OFFLINE
                    </span>
                `;
                    }
                });

                updateCount();
            }

            if (Array.isArray(window.INITIAL_ONLINE_CUSTOMERS)) {
                window.INITIAL_ONLINE_CUSTOMERS.forEach(id => onlineUsers.add(Number(id)));
                updateTable();
            }

            if (!window.Echo) return;

            console.log('Listening for presence updates...');

            window.Echo.join('admins')
                .here(() => {})
                .listen('.user.online', (e) => {
                    if (e.userType === 'customer') {
                        onlineUsers.add(e.userId);
                        updateTable();
                    }
                })
                .listen('.user.offline', (e) => {
                    if (e.userType === 'customer') {
                        onlineUsers.delete(e.userId);
                        updateTable();
                    }
                });

            window.Echo.channel(`admins`)
                .listen('user.online', (e) => {
                    console.log(e);
                });

        });
    </script>


</x-admin.layouts.app>
