<?php

namespace App\Policies;

use App\Models\BudgetStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetStatusPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        return $user->can('budget-status:index');
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('budget-status:index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetStatus  $budgetStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BudgetStatus $budgetStatus)
    {
        return $user->can('budget-status:view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('budget-status:create');
    }

    public function edit(User $user, BudgetStatus $product)
    {
       return $user->can('budget-status:edit');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetStatus  $budgetStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BudgetStatus $budgetStatus)
    {
        return $user->can('budget-status:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetStatus  $budgetStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BudgetStatus $budgetStatus)
    {
        return $user->can('budget-status:delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetStatus  $budgetStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BudgetStatus $budgetStatus)
    {
        return $user->can('budget-status:delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetStatus  $budgetStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BudgetStatus $budgetStatus)
    {
        //
    }
}
