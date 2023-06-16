<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\Administrator;
use Illuminate\Auth\Access\Response;

class PatientPolicy
{
    public function view_any(Administrator $user): bool
    {
        return true;
    }
    public function view(Administrator $user, Patient $midwife): bool
    {
        return true;
    }
    public function create(Administrator $user): bool
    {
        return true;
    }
    public function update(Administrator $user, Patient $midwife): bool
    {
        return true;
    }
    public function delete(Administrator $user, Patient $midwife): bool
    {
        return true;
    }
    public function delete_any(Administrator $user)
    {
        return true;
    }
    public function restore(Administrator $user, Patient $midwife): bool
    {
        return true;
    }
    public function forceDelete(Administrator $user, Patient $midwife): bool
    {
        return true;
    }
}
