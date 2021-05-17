<?php


namespace App\Http\API\Controllers\Auth;

use App\Http\web\Controllers\Controller;
use App\Services\Auth\LogoutService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    /**
     *
     * @param Request $request
     * @param LogoutService $logoutService
     * @return Response
     */
    public function __invoke(Request $request, LogoutService $logoutService): Response
    {
        $logoutService->execute($request);

        return response()->noContent();
    }
}
