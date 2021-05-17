<?php


namespace App\Services\Auth;


use App\Http\API\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginService
{

    use AuthenticatesUsers;

    protected $maxAttempts = 10;
    protected $decayMinutes = 60;


    /**
     *
     * @param LoginRequest $request
     * @return void
     */
    public function execute(LoginRequest $request): void
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            abort(429, 'ログインに複数回失敗したため、1時間ロックします。');
        }

        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return;
        }

        $this->incrementLoginAttempts($request);

        abort(401, 'メールアドレスかパスワードが間違ってます。');
    }

}
