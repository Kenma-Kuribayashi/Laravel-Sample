<?php


namespace App\Services\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutService
{
    /**
     *
     * @param Request $request
     * @return void
     */
    public function execute(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();
    }
}
