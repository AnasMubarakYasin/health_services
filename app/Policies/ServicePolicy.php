<?php

namespace App\Policies;

use App\Models\Administrator;
use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    use HandlesAuthorization;

    public function view_any(Administrator $user)
    {
        return true;
    }

    public function view(Administrator $user, Service $service)
    {
        return true;
    }

    public function create(Administrator $user)
    {
        return true;
    }

    public function update(Administrator $user, Service $service)
    {
        return true;
    }

    public function delete_any(Administrator $user)
    {
        return true;
    }

    public function delete(Administrator $user, Service $service)
    {
        return true;
    }

    public function restore(Administrator $user, Service $service)
    {
        return true;
    }

    public function forceDelete(Administrator $user, Service $service)
    {
        return true;
    }
}
