<?php


namespace App\Http\API\Controllers\User;


use App\Http\API\Requests\User\SendRegistrationEmailRequest;
use App\Http\web\Controllers\Controller;
use App\Services\User\RegisterUserService;
use Illuminate\Http\Response;

class SendRegistrationEmailController extends Controller
{
    /**
     *
     * @return Response
     */
    public function __invoke(
        SendRegistrationEmailRequest $request,
        RegisterUserService $registerUserService): Response
    {
        $registerUserService->execute($request->convert());

        return response()->noContent();
    }
}
