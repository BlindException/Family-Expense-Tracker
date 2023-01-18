<?php

namespace App\Policies;

use App\Models\TransactionCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionCategoryPolicy
{
    use HandlesAuthorization;
        
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TransactionCategory $transactionCategory)
    {
        return auth()->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TransactionCategory $transactionCategory)
    {
        return auth()->user()->is($user);
    }

    }
