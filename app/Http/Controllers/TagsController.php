<?php
namespace App\Http\Controllers;

use App\Tag;
use App\Http\ControllersController;
use Illuminate\Http\Request;

class TagsController extends Controller
{
  public function create(){
    return view('tags.create');
  }
  
  public function store() {
    $inputs = \Request::all();
    Tag::create($inputs);
    // return redirect('articles');
    return view('tags.create');
  }
}
