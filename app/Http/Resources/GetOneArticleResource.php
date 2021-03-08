<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GetOneArticleResource extends Resource
{

    /**
     * @var \App\Domain\Entity\Article
     */
    public $resource;

    /**
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->resource->getTitle(),
            'body' => $this->resource->getBody(),
            'imagePath' => $this->resource->getImagePath(),
            'userId' => $this->resource->getUserId(),
            'tags' => $this->resource->getTags(),
        ];
    }
}