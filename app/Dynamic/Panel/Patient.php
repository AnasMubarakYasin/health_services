<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use App\Models\Patient as ModelsPatient;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;

class Patient extends Panel
{
    public bool $webmanifest = false;
    public bool $service_worker = false;

    public function get_webmanifest(): string
    {
        return asset('patient/site.webmanifest');
    }
    public function get_service_worker(): string
    {
        return Vite::asset('resources/js/components/patient/regis-sw.js');
    }

    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: route('web.patient.dashboard'),
                icon: Blade::render('<x-icons.home stroke="2" />'),
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
                label: "misc",
                name: "sign out",
                link: route('web.patient.logout_perfom'),
                icon: Blade::render('<x-icons.logout />'),
            ),
        ];
    }

    public function profile()
    {
        return route('web.patient.profile');
    }
    public function change_profile()
    {
        return route('web.resource.patient.update', ['patient' => $this->user]);
    }
    public function change_password()
    {
        return route("web.patient.change_password");
    }
    public function notifications()
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
