<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    /**
     * リソースを配列へ変換する
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'hasImagePath' => $this->hasImagePath(),
            'imagePath' => $this->getImagePath(),
            'userId' => $this->getUserId(),
            'hasTags' => $this->hasTags(),
            'tags' => $this->getTags(),
        ];
    }
}