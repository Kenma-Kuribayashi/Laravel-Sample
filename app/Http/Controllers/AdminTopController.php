<?php

namespace App\Http\Controllers;


use App\Services\AdminTop\GetUsers;


class AdminTopController extends Controller
{
  public function __construct() {
  }

  public function index(GetUsers $getUsers) {

    $users = $getUsers->getUsers();

    //dd($users);

    return view('adminTop.index', ['users' => $users]);
  }

}