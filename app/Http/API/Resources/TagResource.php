<?php

namespace App\Http\API\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Collection;

class TagResource extends Resource
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
            'name' => $this->resource->name,
        ];
    }
}
