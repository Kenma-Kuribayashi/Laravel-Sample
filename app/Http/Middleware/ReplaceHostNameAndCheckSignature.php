<?php


namespace App\Http\Middleware;

use App\Services\CheckSignature;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

class ReplaceHostNameAndCheckSignature
{
    private $checkSignature;

    public function __construct(CheckSignature $checkSignature)
    {
        $this->checkSignature = $checkSignature;
    }
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Routing\Exceptions\InvalidSignatureException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->checkSignature->hasValidSignature($request)) {
            return $next($request);
        }

        throw new InvalidSignatureException;
    }
}
