<?php

namespace App\Policies;

use App\Models\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function verified(User $user)
    {
        return $user->hasVerifiedEmail();
    }
}