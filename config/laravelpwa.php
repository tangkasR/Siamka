<?php

return [
    'name' => 'Sistem Informasi Akademik SMK Kartek 2 Jatilawang',
    'manifest' => [
        'name' => env('APP_NAME', 'Sistem Informasi Akademik SMK Kartek 2 Jatilawang'),
        'short_name' => 'SMK Kartek 2 Jatilawang',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#36b5ff',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => '#36b5ff',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/logo-72x72.png',
                'purpose' => 'any',
            ],
            '96x96' => [
                'path' => '/images/icons/logo-96x96.png',
                'purpose' => 'any',
            ],
            '128x128' => [
                'path' => '/images/icons/logo-128x128.png',
                'purpose' => 'any',
            ],
            '144x144' => [
                'path' => '/images/icons/logo-144x144.png',
                'purpose' => 'any',
            ],
            '152x152' => [
                'path' => '/images/icons/logo-152x152.png',
                'purpose' => 'any',
            ],
            '192x192' => [
                'path' => '/images/icons/logo-192x192.png',
                'purpose' => 'any',
            ],
            '384x384' => [
                'path' => '/images/icons/logo-384x384.png',
                'purpose' => 'any',
            ],
            '512x512' => [
                'path' => '/images/icons/logo-512x512.png',
                'purpose' => 'any',
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-screen.png',
            '750x1334' => '/images/icons/splash-screen.png',
            '828x1792' => '/images/icons/splash-screen.png',
            '1125x2436' => '/images/icons/splash-screen.png',
            '1242x2208' => '/images/icons/splash-screen.png',
            '1242x2688' => '/images/icons/splash-screen.png',
            '1536x2048' => '/images/icons/splash-screen.png',
            '1668x2224' => '/images/icons/splash-screen.png',
            '1668x2388' => '/images/icons/splash-screen.png',
            '2048x2732' => '/images/icons/splash-screen.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Sistem Informasi Akademik SMK Kartek 2 Jatilawang',
                'description' => 'Sistem Informasi berbasis web di SMK Kartek 2 Jatilawang',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any",
                ],
            ],
            [
                'name' => 'Sistem Informasi Akademik SMK Kartek 2 Jatilawang',
                'description' => 'Sistem Informasi berbasis web di SMK Kartek 2 Jatilawang',
                'url' => '/shortcutlink2',
            ],
        ],
        'custom' => [],
    ],
];
