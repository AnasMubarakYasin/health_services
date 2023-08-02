<?php

namespace App\Policies;

use App\Models\Administrator;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function view_any(Administrator $user)
    {
        return true;
    }

    public function view(Administrator $user, Schedule $schedule)
    {
        return true;
    }

    public function create(Administrator $user)
    {
        return true;
    }

    public function update(Administrator $user, Schedule $schedule)
    {
        return true;
    }

    public function delete_any(Administrator $user)
    {
        return true;
    }

    public function delete(Administrator $user, Schedule $schedule)
    {
        return true;
    }

    public function restore(Administrator $user, Schedule $schedule)
    {
        return true;
    }

    public function forceDelete(Administrator $user, Schedule $schedule)
    {
        return true;
    }
}
