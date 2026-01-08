<x-admin.layouts.app :title="'Bulk Product Import'">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Bulk Product Import</h2>
                <p class="text-sm text-base-content/60">Import using Excel CSV or XLSX</p>
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
            </div>
        </div>
    </x-slot>
    <div class="container mx-auto py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 bg-gray-800 p-6 rounded shadow">
            @csrf
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend text-base">Excel/CSV File</span>
                </legend>
                <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv"
                    class="file-input block w-full" max="20480" />
                <label class="label">Max size 20MB</label>
            </fieldset>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Import</button>
        </form>
    </div>
    <script>
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files[0].size > 20 * 1024 * 1024) {
                alert('File size must be less than 20 MB');
                this.value = '';
            }
        });
    </script>
</x-admin.layouts.app>
