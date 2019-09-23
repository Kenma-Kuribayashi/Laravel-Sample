<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
  public function about() {
    return view('pages.about');
  }

}
