<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Services\StoreArticle;
use App\Services\GetArticles;
use App\Services\GetTagList;
use App\Services\UpdateArticle;
use App\Services\DestroyArticle;
use App\Services\StoreImage;
use App\Services\GetArticlesByTag;
use App\Services\GetArticle;
use App\Services\GetRecommendedArticles;
use App\Services\BrowsingHistory\StoreBrowsingHistory;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArticlesController extends Controller
{
  private $get_tag_list;

  public function __construct(GetTagList $get_tag_list) {
    $this->middleware('auth')->except(['index', 'show', 'domestic', 'csvExport']); //ログインしなくてもみれる
    $this->get_tag_list = $get_tag_list;
  }

  public function index(GetArticles $get_articles) {
    $articles = $get_articles->get();
    $tag_lists = $this->get_tag_list->get_tag_list();


    return view('articles.index', compact('articles','week','tag_lists'));
  }

  public function show(StoreBrowsingHistory $storeBrowsingHistory, GetArticle $get_article, GetRecommendedArticles $get_recommended_articles, int $article_id, int $user_id = null) {

    $storeBrowsingHistory->store($article_id, $user_id, $get_article);

    $article = $get_article->get_article($article_id);
    $recommended_articles = $get_recommended_articles->get($article_id);
    $tag_lists = $this->get_tag_list->get_tag_list();

    return view('articles.show', compact('article','tag_lists','week','recommended_articles'));
  }

  public function create() {
    $tag_lists = $this->get_tag_list->get_tag_list();

    return view('articles.create', compact('tag_lists'));
  }

  public function store(StoreArticle $service, ArticleRequest $request) {

    dd($request->file('image'));
    $service->store($request->validated(), $request->input('tags'));

    return redirect()->route('articles.index')->with('message', '記事を追加しました。');
  }

  public function edit(Article $article) {
    $tag_lists = $this->get_tag_list->get_tag_list();

    return view('articles.edit', compact('article', 'tag_lists'));
  }

  public function update(UpdateArticle $update_article, ArticleRequest $request, Article $article) {
    $update_article->update_article($request->validated(), $request->input('tags'),$article);

    return redirect()->route('articles.show', [$article->id])->with('message', '記事を更新しました。');
  }

  public function destroy(DestroyArticle $destroy_article, Article $article) {
    $destroy_article->destroy_article($article);

    return redirect()->route('articles.index')->with('message', '記事を削除しました。');
  }

  public function upload(StoreImage $store_image, Request $request,int $article_id) {
    $successful_upload = $store_image->store_image($request, $article_id);

      return redirect()->route('articles.show', [$article_id])->with('message', '記事を更新しました。');
  }

  public function domestic(GetArticlesByTag $get_articles_by_tag, int $tag_id) {
    $articles_by_tag = $get_articles_by_tag->get_articles_by_tag($tag_id);
    $tag_lists = $this->get_tag_list->get_tag_list();

 
    return view('articles.domestic', compact('articles_by_tag','tag_id','week','tag_lists'));
  }

  public function csvExport(Request $request) 
  {
    $response = new StreamedResponse (function() use ($request){
 
      $stream = fopen('php://output', 'w');

      //dd($stream);

      //　文字化け回避
      stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

      // タイトルを追加
      fputcsv($stream, ['id','sample1','sample2','sample3','created_at','updated_at']);

      $articles = Article::all();

      foreach ($articles as $article) {
          fputcsv($stream, [$article->title,$article->body,$article->created_at,$article->updated_at]);
        }

      fclose($stream);
  });
  $response->headers->set('Content-Type', 'application/octet-stream');
  $response->headers->set('Content-Disposition', 'attachment; filename="SampleList.csv"');

  return $response;
  }

}
