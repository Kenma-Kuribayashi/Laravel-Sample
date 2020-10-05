<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{

    /**
     * @var \App\Domain\Entity\Article
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
            'title' => $this->resource->getTitle(),
            'body' => $this->resource->getBody(),
            'hasImagePath' => $this->resource->hasImagePath(),
            'imagePath' => $this->resource->getImagePath(),
            'userId' => $this->resource->getUserId(),
            'hasTags' => $this->resource->hasTags(),
            'tags' => $this->resource->getTags(),
        ];
    }
}