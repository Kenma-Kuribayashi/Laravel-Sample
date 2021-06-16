<?php


namespace App\Http\API\Resources\User;


use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    /**
     * Undocumented variable
     *
     * @var Collection
     */
    public $resource;

    /**
     * リソースを配列へ変換する
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
        ];
    }
}
