<?php


namespace App\Http\API\Controllers\User;

use App\Http\API\Requests\User\ActivateUserRequest;
use App\Http\Middleware\ReplaceHostNameAndCheckSignature;
use App\Http\web\Controllers\Controller;
use App\Services\User\ActivateUserService;
use Illuminate\Http\Response;

class ActivateUserController extends Controller
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
        ActivateUserRequest $request,
        ActivateUserService $activateUserService)
    {
        $activateUserService->execute($request->convert());

        return response()->noContent();
    }
}
