<?php

namespace App\Policies;

use App\Models\OrderLimit;
use App\Models\Administrator;
use Illuminate\Auth\Access\Response;

class OrderLimitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Administrator $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Administrator $user, OrderLimit $orderLimit): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Administrator $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Administrator $user, OrderLimit $orderLimit): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Administrator $user, OrderLimit $orderLimit): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Administrator $user, OrderLimit $orderLimit): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Administrator $user, OrderLimit $orderLimit): bool
    {
        return true;
    }
}
