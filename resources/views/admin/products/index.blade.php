<x-admin.layouts.app :title="'Product Management'">
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Products</h2>
                <p class="text-sm text-base-content/60">Manage your catalog, stock levels, and pricing</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.products.import') }}" class="btn btn-secondary shadow-md shadow-secondary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4zm4 4h8v2H8V8zm0 4h8v2H8v-2zm0 4h8v2H8v-2z" />
                    </svg>
                    Bulk Import
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-md shadow-primary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Product
                </a>
            </div>
        </div>
    </x-slot>

    <div class="card bg-base-100 border border-base-200 shadow-sm">
        <div class="p-4 border-b border-base-200 flex justify-between items-center bg-base-50/50">
            <span class="text-sm font-bold opacity-70">{{ $products->count() }} Total Products</span>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-base-200/50">
                    <tr>
                        <th class="text-[10px] uppercase tracking-widest font-bold">Product</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold text-center">Category</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold text-center">Price</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold text-center">Stock</th>
                        <th class="text-[10px] uppercase tracking-widest font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="hover:bg-base-200/30 transition-colors">
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12 bg-base-200">
                                            @php
                                                $imagePath = null;
                                                if (
                                                    !empty($product->image) &&
                                                    \Illuminate\Support\Facades\Storage::disk('public')->exists(
                                                        $product->image,
                                                    )
                                                ) {
                                                    $imagePath = asset('storage/' . $product->image);
                                                } elseif (config('app.default_product_image')) {
                                                    $imagePath = asset(config('app.default_product_image'));
                                                }
                                            @endphp
                                            @if ($imagePath)
                                                <img src="{{ $imagePath }}" alt="{{ $product->name }}" />
                                            @else
                                                <div
                                                    class="flex items-center justify-center h-full text-base-content/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-black text-sm">{{ $product->name }}</div>
                                        <div class="text-[10px] opacity-50 font-mono italic">#ID-{{ $product->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                <span
                                    class="badge badge-ghost font-medium text-xs">{{ $product->category ?? 'N/A' }}</span>
                            </td>

                            <td class="text-center font-bold text-sm">
                                ${{ number_format($product->price, 2) }}
                            </td>

                            <td class="text-center">
                                @if ($product->stock <= 0)
                                    <div class="badge badge-error gap-1 text-[10px] font-bold uppercase">Out of Stock
                                    </div>
                                @elseif($product->stock <= 5)
                                    <div class="badge badge-warning gap-1 text-[10px] font-bold uppercase">Low:
                                        {{ $product->stock }}</div>
                                @else
                                    <div
                                        class="badge badge-success badge-outline gap-1 text-[10px] font-bold uppercase">
                                        {{ $product->stock }} In Stock</div>
                                @endif
                            </td>

                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-square btn-ghost btn-sm" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-square btn-ghost btn-sm text-info" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <button
                                        class="btn btn-square btn-ghost btn-sm text-base-content/50 hover:text-error"
                                        onclick="delete_modal_{{ $product->id }}.showModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>

                                    <dialog id="delete_modal_{{ $product->id }}"
                                        class="modal modal-bottom sm:modal-middle">
                                        <div class="modal-box border border-error/20">
                                            <div class="flex items-center gap-4 text-error mb-4">
                                                <div class="p-3 bg-error/10 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>
                                                <h3 class="font-black text-lg text-base-content">Are you sure you want
                                                    to delete?
                                                </h3>
                                            </div>
                                            <p class="text-sm text-base-content/70 text-center">
                                                You are about to delete <span
                                                    class="font-bold text-base-content">{{ $product->name }}</span>.
                                                This action cannot be undone and will remove all associated inventory
                                                data.
                                            </p>
                                            <div class="modal-action">
                                                <form method="dialog">
                                                    <button class="btn btn-ghost btn-sm">Cancel</button>
                                                </form>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-error btn-sm px-6 text-white">Delete
                                                        Product</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-20">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 opacity-20 mb-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="text-lg font-bold opacity-50">No products found</p>
                                    <a href="{{ route('admin.products.create') }}"
                                        class="btn btn-link btn-primary">Create your first product</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="p-4 border-t border-base-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-admin.layouts.app>
