<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\Article_tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bb;

class ArticlesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index', 'show', 'domestic']);
  }
  
  public function index() {
    $articles = Article::latest('published_at')->latest('created_at')
      ->published()
      ->paginate(10);
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
    $article = Auth::user()->articles()->create($request->validated());
    $article->tags()->attach($request->input('tags'));
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
  
  public function upload(Request $request, $id){
    $this->validate($request, [
      'image' => [
        'required',
        'file',
        'image',
        'mimes:jpeg,png',]
    ]);
    $article = Article::find($id);  //更新する記事を特定できないので、idから記事を特定
    if ($request->file('image')->isValid([])) {
      $image = base64_encode(file_get_contents($request->image->getRealPath()));
      $article->update(["image" => $image]); 
      return redirect()->route('articles.show', [$article->id])->with('message', '記事を更新しました。');
    } else {
      return redirect()
        ->back()
        ->withInput()
        ->withErrors();
    }
  }
  
  public function domestic($tagname) { //タグのid
    $articles = Article::latest('published_at')->latest('created_at') //全記事を取り出してる
      ->published()
      ->paginate(10);
    return view('articles.domestic', compact('articles','tagname'));
  }
  
}
