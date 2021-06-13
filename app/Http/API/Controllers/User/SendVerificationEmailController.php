<?php


namespace App\Http\API\Controllers\User;


use App\Http\API\Requests\User\SendVerificationEmailRequest;
use App\Http\web\Controllers\Controller;
use App\Services\User\SendVerificationEmailService;
use Illuminate\Http\Response;

class SendVerificationEmailController extends Controller
{
    /**
     *
     * @return Response
     */
    public function __invoke(
        SendVerificationEmailRequest $request,
        SendVerificationEmailService $sendVerificationEmailService)
    {
        $sendVerificationEmailService->execute($request->convert());

        return response()->noContent();
    }
}
