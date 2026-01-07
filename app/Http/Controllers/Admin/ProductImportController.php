<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\BulkProductImportJob;
use Illuminate\Support\Facades\Storage;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        $path = $request->file('file')->store('imports');
        BulkProductImportJob::dispatch($path);

        return back()->with('success', 'Bulk product import has been queued.');
    }
}
