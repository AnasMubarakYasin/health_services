<?php

namespace App\Dynamic;

use App\Models\Administrator;

class Welcome
{
    /** @return Welcome|null */
    public static function create()
    {
        $welcome = new Welcome();
        $welcome->vendor_name = config('dynamic.application.vendor_name');
        $welcome->vendor_year = config('dynamic.application.vendor_year');
        $welcome->vendor_version = config('dynamic.application.vendor_version');
        $welcome->vendor_logo = config('dynamic.application.vendor_logo');
        return $welcome;
    }
    public string $vendor_name = '';
    public string $vendor_year = '';
    public string $vendor_version = '';
    public string $vendor_logo = '';

    public string $locale = '';

    public function get_users()
    {
        return [
            'administrator' => [
                'name' => 'Administrator',
                'login' => route('web.administrator.login_show'),
                'user' => [
                    'name' => 'admin',
                    'password' => 'admin',
                ],
                'demo' => true,
            ],
        ];
    }
}
