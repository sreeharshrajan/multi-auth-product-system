<x-admin.layouts.app :title="'Add Product'">
    <x-slot name="header">
        <h2 class="text-xl font-bold text-base-content">Add Product</h2>
    </x-slot>

    <div class="card">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
            class="card-body gap-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Product Name</span>
                    </label>
                    <input type="text" name="name" placeholder="Enter product name"
                        class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Category</span>
                    </label>
                    <select name="category" class="select select-bordered w-full">
                        <option disabled selected>Pick a category</option>
                        <option>Electronics</option>
                        <option>Clothing</option>
                        <option>Home & Kitchen</option>
                        <option>Books</option>
                        <option>Sports</option>
                        <option>Beauty</option>
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
                <textarea name="description" class="textarea textarea-bordered h-24 w-full" placeholder="Describe your product..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Price</span>
                    </label>
                    <input type="number" name="price" step="0.01" class="input input-bordered w-full"
                        placeholder="0.00" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Stock Quantity</span>
                    </label>
                    <input type="number" name="stock" class="input input-bordered w-full" placeholder="0" required />
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
            </div>

            <div class="card-actions justify-end mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary px-10">Create Product</button>
            </div>
        </form>
    </div>
</x-admin.layouts.app>
