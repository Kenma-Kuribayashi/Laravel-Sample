<?php


namespace App\Services\User;


use App\Notifications\VerifyEmailJapanese;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendVerificationEmailService
{
    /**
     *
     * @param array $request
     * @return void
     */
    public function execute(array $request): void
    {
        //ユーザ作成
        $user = $request['user'];

        //メール送信
        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailJapanese);
        }
    }
}
