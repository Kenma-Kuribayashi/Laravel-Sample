<?php

namespace App\Http\Controllers;


use App\Services\AdminTop\GetUsers;
use App\Services\AdminTop\RegisterContributor;

class AdminTopController extends Controller
{
  public function __construct() {
  }

  public function index(GetUsers $getUsers) {

    $users = $getUsers->getUsers();

    return view('adminTop.index', ['users' => $users]);
  }

  public function register(int $user_id, RegisterContributor $registerContributor) {

    $registerContributor->execute($user_id);

    return redirect()->route('adminTop.index')->with('message', '記事投稿者の登録が完了しました。');
  }

}