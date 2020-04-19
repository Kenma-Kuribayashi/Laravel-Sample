<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrowsingHistory\GetBrowsingHistories;

class BrowsingHistoryController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function index(Request $request, GetBrowsingHistories $getBrowsingHistories) {
    
    $user_id = $request->user()->id;

    $browsingHistories = $getBrowsingHistories->get($user_id);

    dd($browsingHistories);

    return view('browsingHistory.index', ['article_title' => $browsingHistories[0]['article_title']]);
  }

}
