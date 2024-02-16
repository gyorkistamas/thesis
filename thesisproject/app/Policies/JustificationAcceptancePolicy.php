<?php

namespace App\Policies;

use App\Models\JustificationAcceptance;
use App\Models\User;
use Auth;

class JustificationAcceptancePolicy
{
    public function before()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JustificationAcceptance $justificationAcceptance): bool
    {
        if ($user->id == $justificationAcceptance->user_id || $user->id == $justificationAcceptance->Justification->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole('student')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JustificationAcceptance $justificationAcceptance): bool
    {
        if ($user->id == $justificationAcceptance->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JustificationAcceptance $justificationAcceptance): bool
    {
        if ($user->id == $justificationAcceptance->Justification->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JustificationAcceptance $justificationAcceptance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JustificationAcceptance $justificationAcceptance): bool
    {
        return false;
    }
}
