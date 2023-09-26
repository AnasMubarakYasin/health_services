<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use App\Models\Administrator as ModelsAdministrator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;

class Administrator extends Panel
{
    public bool $webmanifest = false;
    public bool $service_worker = false;

    public function get_webmanifest(): string
    {
        return asset('administrator/site.webmanifest');
    }
    public function get_service_worker(): string
    {
        return Vite::asset('resources/js/pages/administrator/regis-sw.js');
    }

    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: route('web.administrator.dashboard'),
                icon: Blade::render('<x-icons.home stroke="2" />'),
            ),
            new Menu(
                name: "service",
                link: route('web.administrator.service.index'),
                icon: Blade::render('<x-icons.square stroke="2" />'),
            ),
            new Menu(
                name: "schedule",
                link: route('web.administrator.schedule.index'),
                icon: Blade::render('<x-icons.calendar stroke="2" />'),
            ),
            new Menu(
                name: "orders",
                link: route('web.administrator.order.index'),
                icon: Blade::render('<x-icons.shop_bag stroke="2" />'),
            ),
            new Menu(
                name: "users",
                link: route('web.administrator.users'),
                icon: Blade::render('<x-icons.users stroke="2" />'),
                submenu: [
                    new Menu(
                        name: "patient",
                        link: route('web.administrator.users.patient.index'),
                    ),
                    new Menu(
                        name: "midwife",
                        link: route('web.administrator.users.midwife.index'),
                    ),
                    new Menu(
                        name: "administrator",
                        link: route('web.administrator.users.administrator.index'),
                    ),
                ]
            ),
            new Menu(
                label: 'system',
                submenu: [
                    new Menu(
                        name: "database",
                        link: route('web.administrator.database'),
                        icon: Blade::render('<x-icons.database stroke="2" />'),
                    ),
                    new Menu(
                        name: "folder",
                        link: route('web.administrator.folder'),
                        icon: Blade::render('<x-icons.folder stroke="2" />'),
                    ),
                    new Menu(
                        name: "settings",
                        link: route('web.administrator.order.index'),
                        icon: Blade::render('<x-icons.settings2 stroke="2" />'),
                    ),
                ],
            ),
        ];
    }
    public function get_user_menus(): array
    {
        return [
            new Menu(
                name: "profile",
                link: route('web.administrator.profile'),
                icon: Blade::render('<x-icons.profile />'),
            ),
            new Menu(
                label: "misc",
                name: "sign out",
                link: route('web.administrator.logout_perfom'),
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
        return $this->user->email;
    }

    public function profile()
    {
        return route('web.administrator.profile');
    }
    public function change_profile()
    {
        return route('web.administrator.change_profile');
    }
    public function change_password()
    {
        return route("web.administrator.change_password");
    }
    public function notifications()
    {
        return route('web.administrator.notification');
    }
    public function empty()
    {
        return route('web.administrator.empty');
    }
    public function signout()
    {
        return route('web.administrator.logout_perfom');
    }
}
