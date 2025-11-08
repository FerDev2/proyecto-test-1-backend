<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ⚠️ Cambia esto a tu dominio frontend (React)
    'allowed_origins' => ['https://proyecto-test-1-ok5r.vercel.app'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
