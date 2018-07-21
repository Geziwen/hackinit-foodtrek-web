<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function plant(User $user) {
        // TODO: Implement
        return true;
    }

    public function harvest(User $user, Transaction $transaction) {
        if ($transaction->status === 'planted') {
            return true;
        }
        return false;
    }
}
