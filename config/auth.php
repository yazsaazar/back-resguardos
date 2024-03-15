<?php
return [
    'guards' => [
        'web' => [
            'driver' => 'jwt',
            'provider' => 'usuarios',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'usuarios',
            'hash' => false,
        ],
    ],

    'providers' => [
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuarios::class,
        ],
    ],
];


