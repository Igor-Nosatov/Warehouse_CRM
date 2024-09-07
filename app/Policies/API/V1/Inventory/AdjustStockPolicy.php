<?php

declare (strict_types = 1);

namespace App\Policies\API\V1\Inventory;

use App\Models\Auth\User;
use App\Models\Inventory\AdjustStock;

class AdjustStockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdjustStock $adjustStock): bool
    {
        return $user->id === $adjustStock->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdjustStock $adjustStock): bool
    {
        return $user->id === $adjustStock->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AdjustStock $adjustStock): bool
    {
        return $user->id === $adjustStock->user_id || $user->hasRole('admin');
    }
}
