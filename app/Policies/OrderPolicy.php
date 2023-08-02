<?php

namespace App\Policies;

use App\Models\Administrator;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view_any(Administrator $user)
    {
        return true;
    }

    public function view(Administrator $user, Order $order)
    {
        return true;
    }

    public function create(Administrator $user)
    {
        return true;
    }

    public function update(Administrator $user, Order $order)
    {
        return true;
    }

    public function delete_any(Administrator $user)
    {
        return true;
    }

    public function delete(Administrator $user, Order $order)
    {
        return true;
    }

    public function restore(Administrator $user, Order $order)
    {
        return true;
    }

    public function forceDelete(Administrator $user, Order $order)
    {
        return true;
    }
}
