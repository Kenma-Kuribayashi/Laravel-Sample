<?php


namespace App\Services\Auth;


use Illuminate\Support\Facades\Auth;

class LoginService
{

    /**
     *
     * @param array $request
     * @return void
     */
    public function execute(array $request): void
    {
        if(!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            abort(401, 'メールアドレスかパスワードが間違ってます。');
        }
    }
}
