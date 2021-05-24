<?php


namespace App\Services\User;


use App\Notifications\VerifyEmailJapanese;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class SendRegistrationEmailService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     *
     * @param array $request
     * @return void
     */
    public function execute(array $request): void
    {
        //既に登録されていないかチェック
        if($this->userRepository->findByEmail($request['email'])) {
            abort(400, 'このメールアドレスは既に登録済みです。');
        }

        //ユーザ作成
        $user = $this->userRepository->store($request['name'], $request['email'], $request['password']);

        //ログイン
        Auth::guard()->login($user);

        //メール送信
        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailJapanese);
        }
    }
}
