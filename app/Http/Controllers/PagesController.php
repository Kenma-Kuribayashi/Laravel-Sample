<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function about() {
    $data = [];
    $data["first_name"] = "Luke";
    $data["last_name"] = "Skywalker";
    
    return view('pages.about', $data);
  }
  
  public function contact()
  {
    return view('pages.contact');
  }
}
