<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductImportRequest;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function import(ProductImportRequest $request)
    {
        try {

            Log::info('Received product import request', [
                'admin_id'   => auth()->guard('admin')->id(),
                'file_name'  => $request->file('file')->getClientOriginalName(),
                'file_size'  => $request->file('file')->getSize(),
            ]);

            // Store the uploaded file temporarily
            $path = $request->file('file')->store('imports');

            // Queue the import job
            Excel::queueImport(
                new ProductImport,
                $request->file('file')
            );

            Log::info('Product import has been queued', [
                'admin_id'   => auth()->guard('admin')->id(),
                'file_path'  => $path,
            ]);

            return back()->with('success', 'Bulk product import has been queued.');
        } catch (Throwable $e) {
            return back()->withErrors(['file' => 'There was an error processing the file: ' . $e->getMessage()]);
        }
    }
}
