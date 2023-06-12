<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use Illuminate\Support\Facades\Blade;

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
        $panel->pwd = base_path();
        $panel->name = config('dynamic.application.name');
        $panel->logo = config('dynamic.application.logo');
        return $panel;
    }
    public string $pwd;

    public ?Menu $menu = null;
    public mixed $user;

    public string $title = 'Panel';
    public string $locale = '';
    public string $template = '';

    public string $name = '';
    public string $logo = '';

    public string $token = '';
    public mixed $preference;

    public bool $webmanifest = false;
    public bool $service_worker = false;
    public function __construct()
    {
    }
    public function get_user_photo(): string
    {
        return "/logo.png";
    }
    public function get_user_name(): string
    {
        return $this->user->name;
    }
    public function get_user_identifier(): string
    {
        return $this->user->email;
    }
    public function get_user_menus(): array
    {
        return [
            new Menu(
                name: "profile",
                link: "/profile",
                icon: Blade::render('<x-icons.profile />'),
            ),
            new Menu(
                name: "settings",
                link: "/settings",
                icon: Blade::render('<x-icons.settings />'),
            ),
        ];
    }
    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: "/dashboard",
                icon: Blade::render('<x-icons.home />'),
            ),
        ];
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
