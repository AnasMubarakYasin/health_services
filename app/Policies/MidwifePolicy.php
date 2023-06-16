<?php

namespace App\Policies;

use App\Models\Midwife;
use App\Models\Administrator;
use Illuminate\Auth\Access\Response;

class MidwifePolicy
{
    public function view_any(Administrator $user): bool
    {
        return true;
    }
    public function view(Administrator $user, Midwife $midwife): bool
    {
        return true;
    }
    public function create(Administrator $user): bool
    {
        return true;
    }
    public function update(Administrator $user, Midwife $midwife): bool
    {
        return true;
    }
    public function delete(Administrator $user, Midwife $midwife): bool
    {
        return true;
    }
    public function delete_any(Administrator $user)
    {
        return true;
    }
    public function restore(Administrator $user, Midwife $midwife): bool
    {
        return true;
    }
    public function forceDelete(Administrator $user, Midwife $midwife): bool
    {
        return true;
    }
}
