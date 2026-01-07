<x-admin.layouts.app :title="'Bulk Product Import'">
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-6">Bulk Product Import</h2>
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
            <div>
                <label for="file" class="block font-medium mb-2">Excel/CSV File</label>
                <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required
                    class="block w-full border border-gray-600 rounded px-3 py-2 bg-gray-900 text-white" />
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Queue
                Import</button>
        </form>
    </div>
</x-admin.layouts.app>
