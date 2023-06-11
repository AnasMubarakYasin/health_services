<?php

use App\Dynamic\Panel\Administrator as PanelAdministrator;
use App\Models\Administrator;

return [
    'application' => [
        'name' => env('APP_NAME', 'Bladerlaiga'),
        'version' => env('APP_VER', '0.1.0'),
        'logo' => env('APP_LOGO', '/logo.png'),
        'favicon' => env('APP_FAV', '/favicon.ico'),
        'vendor_name' => 'Bladerlaiga',
        'vendor_version' => '0.5.12',
        'vendor_year' => '2023',
        'vendor_logo' => '/logo.png',
        'template' => 'simple',
        'enable_demo' => true,
        'enable_error_track' => false,
    ],
    'locales' => ['en' => 'english', 'id' => 'indonesia'],
    'stakeholder' => [
        'dev' => ['wm337708@gmail.com'],
        'client' => ['bladerlaiga.97@gmail.com'],
    ],
    'templates' => [
        'simple' => [
            'name' => 'Simple',
            'version' => '0.6.0',
            'deps' => ['flowbite'],
            'thumb' => '/templates/simple.png',
        ],
        'modern' => [
            'name' => 'Modern',
            'version' => '0.2.0',
            'deps' => ['tailwind element', 'daisyui'],
            'thumb' => '/templates/modern.png',
        ],
    ],
    'panel' => [
        Administrator::class => PanelAdministrator::class,
    ],
    'user' => [],
    'aggrement' => [
        'finish_at' => '2023-06-20 00:00:00',
        'finished' => false,
    ],
];
