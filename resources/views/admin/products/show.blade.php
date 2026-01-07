<x-admin.layouts.app :title="'Product Details'">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Product Overview</h2>
                <p class="text-sm text-base-content/60"> #ID-{{ $product->id }} • Added
                    {{ $product->created_at->format('M d, Y') }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm px-6">Edit
                    Product</a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

        <div class="lg:col-span-4 flex">
            <div class="card bg-base-100 shadow-sm border border-base-200 w-full overflow-hidden">
                <div class="relative h-full min-h-[400px]">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . config('app.default_product_image')) }}"
                            alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover">
                    @endif

                    <div class="absolute top-4 left-4">
                        <span
                            class="badge badge-neutral bg-black/50 backdrop-blur-md text-white border-none py-3 px-4 uppercase text-[10px] font-bold tracking-widest">
                            {{ $product->category ?? 'General' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 flex flex-col gap-6">
            <div class="card bg-base-100 shadow-sm border border-base-200 flex-grow">
                <div class="card-body justify-between">
                    <div>
                        <div class="flex justify-between items-start">
                            <h1 class="text-4xl font-black text-base-content leading-none">{{ $product->name }}</h1>
                        </div>

                        <div class="divider"></div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xs uppercase font-bold text-base-content/40 tracking-widest mb-2">
                                    Description</h3>
                                <p class="text-base-content/80 text-lg leading-relaxed max-w-2xl">
                                    {{ $product->description ?: 'No detailed description available for this item.' }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="p-4 rounded-2xl bg-base-200/50 border border-base-300">
                            <p class="text-xs font-bold text-base-content/50 uppercase tracking-tighter">Price</p>
                            <p class="text-3xl font-black text-base-content">${{ number_format($product->price, 2) }}
                            </p>
                        </div>
                        <div class="p-4 rounded-2xl bg-base-200/50 border border-base-300">
                            <p class="text-xs font-bold text-base-content/50 uppercase tracking-tighter">Inventory</p>
                            <div class="flex items-baseline gap-2">
                                <p
                                    class="text-3xl font-black {{ $product->stock > 5 ? 'text-base-content' : 'text-error' }}">
                                    {{ $product->stock }}
                                </p>
                                <span
                                    class="text-xs font-bold uppercase {{ $product->stock > 5 ? 'text-success' : 'text-error' }}">
                                    {{ $product->stock > 5 ? 'Units' : 'Low Stock' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.app>
