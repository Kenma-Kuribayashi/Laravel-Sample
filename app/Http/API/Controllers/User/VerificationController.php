<?php


namespace App\Http\API\Controllers\User;

use App\Http\API\Requests\User\VerificationRequest;
use App\Http\Middleware\ReplaceHostNameAndCheckSignature;
use App\Http\web\Controllers\Controller;
use App\Services\User\VerificationService;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(ReplaceHostNameAndCheckSignature::class);
        $this->middleware('throttle:6,1');
    }

    /**
     *
     * @return Response
     */
    public function __invoke(
        VerificationRequest $request,
        VerificationService $activateUserService)
    {
        $activateUserService->execute($request->convert());

        return response()->noContent();
    }
}
