<x-admin.layouts.app :title="'Product Form'">
    <x-slot name="header">
        <h2 class="text-xl font-bold text-base-content">Edit Product</h2>
    </x-slot>

    <div class="card">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="card-body gap-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Product Name</span>
                    </label>
                    <input type="text" name="name" value="{{ $product->name ?? '' }}" placeholder="Enter product name" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Category</span>
                    </label>
                    <select name="category" class="select select-bordered w-full">
                        <option disabled {{ empty($product->category) ? 'selected' : '' }}>Pick a category</option>
                        <option value="Electronics" {{ $product->category == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Clothing" {{ $product->category == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="Home & Kitchen" {{ $product->category == 'Home & Kitchen' ? 'selected' : '' }}>Home & Kitchen</option>
                        <option value="Books" {{ $product->category == 'Books' ? 'selected' : '' }}>Books</option>
                        <option value="Sports" {{ $product->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Beauty" {{ $product->category == 'Beauty' ? 'selected' : '' }}>Beauty</option>
                    </select>
                </div>
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold">Description</span>
                    <sup class="label-text-alt text-base-content/50">
                        <small>Optional</small>
                    </sup>
                </label>
                <textarea name="description" class="textarea textarea-bordered h-24 w-full" placeholder="Describe your product...">{{ $product->description ?? '' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Price</span>
                    </label>
                    <input type="number" name="price" step="0.01" value="{{ $product->price ?? '' }}" class="input input-bordered w-full" placeholder="0.00" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Stock Quantity</span>
                    </label>
                    <input type="number" name="stock" value="{{ $product->stock ?? '' }}" class="input input-bordered w-full" placeholder="0" required />
                </div>
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold">Product Image</span>
                    <sup class="label-text-alt text-base-content/50">
                        <small>Optional</small>
                    </sup>
                </label>
                <input type="file" name="image" class="file-input file-input-bordered w-full" />
                <div class="label text-xs mt-0.5">
                    Recommended size: 300x300px (JPG, PNG)
                </div>
                @php
                    $imagePath = null;
                    if (isset($product) && !empty($product->image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
                        $imagePath = asset('storage/' . $product->image);
                    }
                @endphp
                @if ($imagePath)
                    <div class="flex items-center gap-4 p-3 bg-base-200 rounded-xl w-fit mt-2">
                        <img src="{{ $imagePath }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                        <span class="text-xs font-medium opacity-60">Current Image</span>
                    </div>
                @endif
            </div>

            <div class="card-actions justify-end mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary px-10">Update Product</button>
            </div>
        </form>
    </div>
</x-admin.layouts.app>
