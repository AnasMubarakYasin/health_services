<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use App\Models\Patient as ModelsPatient;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;

class Patient extends Panel
{
    public bool $webmanifest = true;
    public bool $service_worker = true;

    public function get_webmanifest(): string
    {
        return asset('patient/site.webmanifest');
    }
    public function get_service_worker(): string
    {
        return Vite::asset('resources/js/pages/patient/regis-sw.js');
    }

    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: route('web.patient.dashboard'),
                icon: Blade::render('<x-icons.home stroke="2" />'),
            ),
            new Menu(
                name: "history",
                link: route('web.patient.history'),
                icon: Blade::render('<x-icons.clock stroke="2" />'),
            ),
        ];
    }
    public function get_user_menus(): array
    {
        return [
            new Menu(
                name: "profile",
                link: route('web.patient.profile'),
                icon: Blade::render('<x-icons.profile />'),
            ),
            new Menu(
                name: "settings",
                link: route('web.patient.settings'),
                icon: Blade::render('<x-icons.settings />'),
            ),
            new Menu(
                label: "misc",
                name: "sign out",
                link: route('web.patient.logout_perfom'),
                icon: Blade::render('<x-icons.logout />'),
            ),
        ];
    }
    public function get_user_landing_menus(): array
    {
        return [
            new Menu(
                name: "profile",
                link: route('web.patient.profile'),
                icon: Blade::render('<x-icons.profile />'),
            ),
            new Menu(
                name: "notification",
                link: route('web.patient.notification'),
                icon: Blade::render('<x-icons.notification />'),
            ),
            new Menu(
                name: "settings",
                link: route('web.patient.settings'),
                icon: Blade::render('<x-icons.settings />'),
            ),
            new Menu(
                label: "misc",
                name: "sign out",
                link: route('web.patient.logout_perfom'),
                icon: Blade::render('<x-icons.logout />'),
            ),
        ];
    }
    public function get_user_photo(): string
    {
        return $this->user->photo_url;
    }
    public function get_user_identifier(): string
    {
        return $this->user->fullname ?: "-";
    }

    public function profile()
    {
        return route('web.patient.profile');
    }
    public function change_profile()
    {
        return route('web.patient.change_profile');
    }
    public function change_password()
    {
        return route("web.patient.change_password");
    }
    public function notification()
    {
        return route('web.patient.notification');
    }
    public function empty()
    {
        return route('web.patient.empty');
    }
    public function signout()
    {
        return route('web.patient.logout_perfom');
    }
}
