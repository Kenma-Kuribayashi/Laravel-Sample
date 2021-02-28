<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Tag\GetTags;
use App\Http\Resources\TagResource;

class TagsController extends Controller
{

  public function __construct() {
  }

  public function index(GetTags $getTags) {

    $tags = $getTags->execute();

    return TagResource::collection($tags);

  }

}
