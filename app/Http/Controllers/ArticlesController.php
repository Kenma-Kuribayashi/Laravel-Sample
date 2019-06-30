<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index', 'show']);
  }
  
  public function index() {
    $articles = Article::latest('published_at')->latest('created_at')
      ->published()
      ->get();
    return view('articles.index', compact('articles'));
  }
 
  public function show(Article $article) {
    return view('articles.show', compact('article'));
  }
  
  public function create()
  {
    $tag_list = Tag::pluck('name', 'id');
    return view('articles.create', compact('tag_list'));
  }
  
  public function store(ArticleRequest $request) {
    Auth::user()->articles()->create($request->validated());
    return redirect()->route('articles.index')->with('message', '記事を追加しました。');
  }
    
  public function edit(Article $article) {
    $tag_list = Tag::pluck('name', 'id');
    return view('articles.edit', compact('article', 'tag_list'));
  }
 
  public function update(ArticleRequest $request, Article $article) {
    $article->update($request->validated());
    $article->tags()->sync($request->input('tags'));
    return redirect()->route('articles.show', [$article->id])->with('message', '記事を更新しました。');
  }
  
  public function destroy(Article $article) {
    
    $article->delete();
 
    return redirect()->route('articles.index')->with('message', '記事を削除しました。');
  }
  
  public function upload(Request $request,Article $article){
    $this->validate($request, [
      'image' => [
        'required',
        'file',
        'image',
        'mimes:jpeg,png',]
    ]);
    $image = base64_encode(file_get_contents($request->image->getRealPath()));
    Article::insert([
      "image" => $image
    ]);
    return view('dashboard');
    // if ($request->file('file')->isValid([])) {
    //   $path = $request->file('file')->store('public');
    //   return view('articles.show', compact('article'))->with('filename', basename($path));
    // } else {
    //   return redirect()
    //     ->back()
    //     ->withInput()
    //     ->withErrors();
    // }
  }
  
}
