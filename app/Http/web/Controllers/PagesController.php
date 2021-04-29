<?php

namespace App\Http\web\Controllers;

class PagesController extends Controller
{
  public function about() {
    return view('pages.about');
  }

}
