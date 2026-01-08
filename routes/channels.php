<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admins', function ($admin) {
    return [
        'id' => $admin->id,
        'name' => $admin->name,
        'type' => 'admin',
    ];
}, ['guards' => ['web', 'admin']]);


Broadcast::channel('customers', function ($customer) {
    return [
        'id' => $customer->id,
        'name' => $customer->name,
        'type' => 'customer',
    ];
}, ['guards' => ['web', 'customer']]);
