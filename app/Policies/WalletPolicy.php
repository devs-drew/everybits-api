<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\Response;

class WalletPolicy
{
    /**
     * Determine whether the user can modify any wallets.
     *
     * @param  User $user
     * @return Response
     */
    public function modify(User $user, Wallet $wallet): Response
    {
        return $wallet->user_id === $user->id ?
            Response::allow() :
            Response::deny('You do not own this wallet.');
    }
}
