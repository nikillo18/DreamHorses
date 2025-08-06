<?php

namespace App\Policies;

use App\Models\Horse;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HorsePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Horse $horse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Assuming only authenticated users can create horses
      return true;    
}

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Horse $horse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Horse $horse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Horse $horse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Horse $horse): bool
    {
        return false;
    }
    
}
