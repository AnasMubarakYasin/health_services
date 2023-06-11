<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;

class Panel
{
    static array $locales;
    /** @return Panel */
    public static function create($user = null)
    {
        if (!$user) {
            throw new \Error("user not set", 403);
        };
        self::$locales = config('dynamic.locales');
        $class = config('dynamic.panel')[$user];
        /** @var Panel */
        $panel = new $class();
        $panel->name = config('dynamic.application.name');
        $panel->logo = config('dynamic.application.logo');
        return $panel;
    }
    public ?Menu $menu = null;
    public mixed $user;

    public string $title = 'Panel';
    public string $locale = '';
    public string $template = '';

    public string $name = '';
    public string $logo = '';

    public string $token = '';
    public mixed $preference = [];

    public bool $webmanifest = false;
    public bool $service_worker = false;
    public function __construct()
    {
    }
    public function get_user_photo(): string
    {
        return "";
    }
    public function get_user_name(): string
    {
        return $this->user->name;
    }
    public function get_user_identifier(): string
    {
        return $this->user->email;
    }
    public function get_menus(): array
    {
        return [];
    }
    public function get_name(): string
    {
        return "";
    }
    public function get_logo(): string
    {
        return "";
    }
    public function get_favicon(): string
    {
        return "";
    }
    public function get_webmanifest(): string
    {
        return "";
    }
    public function get_service_worker(): string
    {
        return "";
    }

    public function profile()
    {
        return "";
    }
    public function profile_update()
    {
        return "";
    }
    public function change_password()
    {
        return "";
    }
    public function notifications()
    {
        return "";
    }
    public function signout()
    {
        return "";
    }
}
