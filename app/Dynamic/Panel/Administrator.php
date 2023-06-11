<?php

namespace App\Dynamic\Panel;

use App\Dynamic\Menu;
use App\Models\Administrator as ModelsAdministrator;
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
        return Vite::asset('resources/js/components/administrator/regis-sw.js');
    }

    public function get_menus(): array
    {
        return [
            new Menu(
                name: "dashboard",
                link: route('web.administrator.dashboard'),
                icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
              </svg>
              '
            ),
            new Menu(
                name: "users",
                link: route('web.administrator.users'),
                icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
              </svg>
              ',
                submenu: [
                    new Menu(
                        name: "administrator",
                        link: route('web.administrator.users.administrator.list'),
                        pname: "view_any",
                        pclass: ModelsAdministrator::class,
                    ),
                ]
            ),
        ];
    }

    public function profile()
    {
        return route('web.administrator.profile');
    }
    public function change_profile()
    {
        return route('web.resource.administrator.update', ['administrator' => $this->user]);
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
