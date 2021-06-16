<?php

return [
    'name' => 'Backpackbuddy Admin',
    'manifest' => [
        'name' => 'Backpackbuddy Admin',
        'short_name' => 'Backpackbuddy',
        'start_url' => '/',
        'background_color' => '#d4f4ff',
        'theme_color' => '#d4f4ff',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => '#d4f4ff',
        'icons' => [
            '180x180' => [
                'path' => '/images/icons/apple-icon-180.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/manifest-icon-192.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/manifest-icon-512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/apple-splash-640-1136.jpg',
            '750x1334' => '/images/icons/apple-splash-750-1334.jpg',
            '828x1792' => '/images/icons/apple-splash-828-1792.jpg',
            '1125x2436' => '/images/icons/apple-splash-1125-2436.jpg',
            '1242x2208' => '/images/icons/apple-splash-1242-2208.jpg',
            '1242x2688' => '/images/icons/apple-splash-1242-2688.jpg',
            '1536x2048' => '/images/icons/apple-splash-1536-2048.jpg',
            '1668x2224' => '/images/icons/apple-splash-1668-2224.jpg',
            '1668x2388' => '/images/icons/apple-splash-1668-2388.jpg',
            '2048x2732' => '/images/icons/apple-splash-2048-2732.jpg',
        ],
        'shortcuts' => [
            [
                'name' => 'Pending Orders',
                'description' => 'Order that currently pending',
                'url' => '/order/pending',
                'icons' => [
                    "src" => "/images/icons/apple-icon-180.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'New Itinerary',
                'description' => 'Create New Itinerary',
                'url' => '/itinerary/create'
            ]
        ],
        'custom' => []
    ]
];
