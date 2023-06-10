<?php

namespace App\Policies;

use App\Models\Administrator;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministratorPolicy
{
    use HandlesAuthorization;

    public function view_any(Administrator $user)
    {
        return true;
    }

    public function view(Administrator $user, Administrator $administrator)
    {
        return true;
    }

    public function create(Administrator $user)
    {
        return true;
    }

    public function update(Administrator $user, Administrator $administrator)
    {
        return true;
    }

    public function delete_any(Administrator $user)
    {
        return true;
    }

    public function delete(Administrator $user, Administrator $administrator)
    {
        return true;
    }

    public function restore(Administrator $user, Administrator $administrator)
    {
        return true;
    }

    public function forceDelete(Administrator $user, Administrator $administrator)
    {
        return true;
    }
}
