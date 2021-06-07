<?php


namespace App\Services\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;

class ActivateUserService
{
    use VerifiesEmails;

    /**
     *
     * @param array $request
     * @return void
     * @throws AuthorizationException
     */
    public function execute(array $request): void
    {
        if ($request['id'] != $request['user']->getKey()) {
            throw new AuthorizationException;
        }

        if ($request['user']->hasVerifiedEmail()) {
            return;
        }

        if ($request['user']->markEmailAsVerified()) {
            event(new Verified($request['user']));
        }
    }
}
