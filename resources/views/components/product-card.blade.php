@php
    $imagePath = null;
    if (!empty($product->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
        $imagePath = asset('storage/' . $product->image);
    } elseif (config('app.default_product_image')) {
        $imagePath = asset(config('app.default_product_image'));
    }
@endphp

<div
    class="group card bg-base-100 w-full shadow-md hover:shadow-2xl transition-all duration-300 border border-base-200 overflow-hidden rounded-2xl">
    <figure class="relative h-50 w-full overflow-hidden bg-base-300">
        @if ($imagePath)
            <img src="{{ $imagePath }}" alt="{{ $product->name }}"
                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105" />
        @endif

        @if ($product->category)
            <div class="absolute top-4 left-4">
                <span
                    class="badge badge-neutral bg-black/70 backdrop-blur-md text-white border-none font-bold text-[10px] uppercase tracking-[0.2em] py-3 px-4 shadow-lg">
                    {{ $product->category }}
                </span>
            </div>
        @endif
    </figure>

    <div class="card-body p-6 gap-0">
        <div class="flex justify-between items-baseline mb-3">
            <h2 class="text-2xl font-black text-base-content line-clamp-2 tracking-tighter leading-none">
                {{ $product->name }}
            </h2>
        </div>
        @if ($product->description)
            <p class="text-sm text-base-content/70 line-clamp-2 mb-2 font-medium">
                {{ $product->description }}
            </p>
        @endif

        <!-- Price -->
        <div class="flex justify-between items-center mb-4">
            <div class="text-xl font-black text-primary">
                ${{ number_format($product->price, 2) }}
            </div>
        </div>


        <div class="card-actions items-center justify-between mt-auto">
            @if ($product->stock > 0)
                <button
                    class="btn btn-primary btn-md rounded-xl px-8 font-black uppercase tracking-widest text-xs shadow-lg shadow-primary/30 active:scale-95 transition-all">
                    Buy Now
                </button>
            @endif
        </div>
    </div>
</div>
