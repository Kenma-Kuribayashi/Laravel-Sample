<?php


namespace App\Services\User;

use App\Eloquent\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RegisterUserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     *
     * @param array $request
     * @return User $user
     */
    public function execute(array $request): User
    {
        //既に登録されていないかチェック
        if($this->userRepository->findByEmail($request['email'])) {
            abort(400, 'このメールアドレスは既に登録済みです。');
        }

        //ユーザ作成
        $user = $this->userRepository->store($request['name'], $request['email'], $request['password']);

        //ログイン
        Auth::guard()->login($user);

        return $user;
    }
}
