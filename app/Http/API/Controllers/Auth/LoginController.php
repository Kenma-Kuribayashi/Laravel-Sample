<?php

namespace App\Http\API\Controllers\Auth;

use App\Http\API\Requests\Auth\LoginRequest;
use App\Http\web\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     *
     * @param LoginRequest $request
     * @param LoginService $loginService
     * @return Response
     */
    public function __invoke(LoginRequest $request, LoginService $loginService): Response
    {
        $loginService->execute($request->convert());

        return response()->noContent();
    }
}
