<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
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

    public function confirm(User $user, Transaction $transaction) {
        if ($transaction->status !== 'requested') {
            return false;
        }
        if ($transaction->receiver->id != $user->id) {
            return false;
        }
        return true;
    }

    public function request(User $user) {
        return true;
    }

    public function receive(User $user, Transaction $transaction) {
        if ($transaction->status !== 'confirmed') {
            return false;
        }
        if ($transaction->receiver->id !== $user->id) {
            return false;
        }
        return true;
    }

    public function destroy(User $user, Transaction $transaction) {
        if ($transaction->status !== 'requested') {
            return false;
        }
        if ($transaction->sender->id !== $user->id) {
            return false;
        }
        return true;
    }
}
