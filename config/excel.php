<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel Excel Import/Export Config
    |--------------------------------------------------------------------------
    |
    | You can customize the default import/export settings here.
    |
    */

    'imports' => [
        'read_only' => true,
        'heading_row' => [
            'formatter' => 'slug',
        ],
    ],

    'exports' => [
        'chunk_size' => 1000,
    ],

    'transactions' => [
        'handler' => 'db',
    ],

    'temporary_files' => [
        'local_path' => storage_path('app/imports/temp'),
        'remote_disk' => null,
    ],
];
