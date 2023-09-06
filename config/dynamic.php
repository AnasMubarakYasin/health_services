<?php

use App\Dynamic\Panel\Administrator as PanelAdministrator;
use App\Models\Administrator;
use App\Dynamic\Panel\Patient as PanelPatient;
use App\Models\Patient;
use App\Dynamic\Panel\Midwife as PanelMidwife;
use App\Models\Midwife;

return [
    'application' => [
        'name' => env('APP_NAME', 'Bladerlaiga'),
        'version' => env('APP_VER', '0.4.3'),
        'logo' => env('APP_LOGO', '/logo.png'),
        'favicon' => env('APP_FAV', '/favicon.ico'),
        'vendor_name' => 'Bladerlaiga',
        'vendor_version' => '0.8.2',
        'vendor_year' => '2023',
        'vendor_logo' => '/logo.png',
        'template' => 'modern',
        'enable_demo' => true,
        'enable_error_boundary' => true
    ],
    'stakeholder' => [
        'dev' => [
            'mails' => ['bladerlaiga.97@gmail.com'],
            'chat_id' => -1001909982316,
        ],
        'client' => [
            'mails' => [],
            'chat_id' => "",
        ],
    ],
    'locales' => ['en' => 'english', 'id' => 'indonesia'],
    'templates' => [
        'simple' => [
            'name' => 'Simple',
            'version' => '0.6.4',
            'deps' => ['flowbite'],
            'thumb' => '/images/screenshots/simple.png',
        ],
        'modern' => [
            'name' => 'Modern',
            'version' => '0.2.6',
            'deps' => ['tailwind element', 'daisyui'],
            'thumb' => '/images/screenshots/modern.png',
        ],
    ],
    'panel' => [
        Administrator::class => PanelAdministrator::class,
        Patient::class => PanelPatient::class,
        Midwife::class => PanelMidwife::class,
    ],
    'user' => [],
    'aggrement' => [
        'finish_at' => '2023-08-14 00:00:00',
        'finished' => false,
    ],
];
