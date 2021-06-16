<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CheckSignature
{
    /**
     *
     * @param Request $request
     * @return bool
     */
    public function hasValidSignature(Request $request): bool
    {
        // フロントエンドのURLで送っているのでそっちにリプレイスする
        $url = str_replace(config('app.api_host'), config('app.front_host'), $request->url());

        $original = rtrim($url.'?'.Arr::query(
                Arr::except($request->query(), 'signature')
            ), '?');

        $expires = $request->query('expires');

        $signature = hash_hmac('sha256', $original, config('app.key'));

        return hash_equals($signature, (string) $request->query('signature', '')) &&
            ! ($expires && Carbon::now()->getTimestamp() > $expires);
    }
}
