<?php

namespace App\Http\API\Controllers\Tag;

use App\Http\web\Controllers\Controller;
use App\Services\Tag\GetTags;
use App\Http\API\Resources\TagResource;

class GetTagsController extends Controller
{

  public function __invoke(GetTags $getTags) {

    $tags = $getTags->execute();

    return TagResource::collection($tags);
  }

}
