<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use App\Models\Midwife as ModelsMidwife;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;

class Midwife extends Panel
{
    public bool $webmanifest = true;
    public bool $service_worker = true;

    public function get_webmanifest(): string
    {
        return asset('midwife/site.webmanifest');
    }
    public function get_service_worker(): string
    {
        return Vite::asset('resources/js/pages/midwife/regis-sw.js');
    }

    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: route('web.midwife.dashboard'),
                icon: Blade::render('<x-icons.home stroke="2" />'),
            ),
            new Menu(
                name: "history",
                link: route('web.midwife.history'),
                icon: Blade::render('<x-icons.clock stroke="2" />'),
            ),
        ];
    }
    public function get_user_menus(): array
    {
        return [
            new Menu(
                name: "profile",
                link: route('web.midwife.profile'),
                icon: Blade::render('<x-icons.profile />'),
            ),
            new Menu(
                name: "settings",
                link: route('web.midwife.settings'),
                icon: Blade::render('<x-icons.settings />'),
            ),
            new Menu(
                label: "misc",
                name: "sign out",
                link: route('web.midwife.logout_perfom'),
                icon: Blade::render('<x-icons.logout />'),
            ),
        ];
    }
    public function get_user_photo(): string
    {
        return $this->user->photo;
    }
    public function get_user_identifier(): string
    {
        return $this->user->fullname ?: "-";
    }

    public function profile()
    {
        return route('web.midwife.profile');
    }
    public function change_profile()
    {
        return route('web.midwife.change_profile');
    }
    public function change_password()
    {
        return route("web.midwife.change_password");
    }
    public function notifications()
    {
        return route('web.midwife.notification');
    }
    public function empty()
    {
        return route('web.midwife.empty');
    }
    public function signout()
    {
        return route('web.midwife.logout_perfom');
    }
}
