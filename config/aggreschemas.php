<?php

return [
    'master_schemas' => env('DB_SCHEMA_MASTER', 'public'),
    'slave_schemas' => env('DB_SCHEMA_SLAVES', [
        'slave1', 'slave2'
    ])
];
