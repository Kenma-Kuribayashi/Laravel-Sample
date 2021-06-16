<?php


namespace App\Http\API\Controllers\User;


use App\Http\API\Requests\User\SendRegistrationEmailRequest;
use App\Http\API\Resources\User\UserResource;
use App\Http\web\Controllers\Controller;
use App\Services\User\RegisterUserService;


class RegisterUserController extends Controller
{
    /**
     *
     * @return UserResource
     */
    public function __invoke(
        SendRegistrationEmailRequest $request,
        RegisterUserService $registerUserService): UserResource
    {
        return new UserResource($registerUserService->execute($request->convert()));
    }
}
