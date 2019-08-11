<?php
namespace App\Http\Controllers;

use App\Tag;
use App\Http\ControllersController;
use Illuminate\Http\Request;

class TagsController extends Controller
{
  public function index() {
    $tags = Tag::all();
    return view('tags.index', compact('tags'));
  }
  
  public function create() {
    return view('tags.create');
  }
  
  public function store() {
    $inputs = \Request::all();
    Tag::create($inputs);
    return redirect('tags');
  }
  
  public function destroy($id) {
    $tag = Tag::findOrFail($id);
    $tag->delete();
    return redirect('tags');
  }
}
