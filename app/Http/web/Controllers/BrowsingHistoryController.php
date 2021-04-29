<?php

namespace App\Http\web\Controllers;

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

    return view('browsingHistory.index', ['browsingHistories' => $browsingHistories]);
  }

}
