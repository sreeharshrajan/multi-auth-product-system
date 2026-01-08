<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/_debug/broadcast', function () {
    return [
        'default' => config('broadcasting.default'),
        'connections' => array_keys(config('broadcasting.connections')),
        'env' => env('BROADCAST_CONNECTION'),
    ];
});
