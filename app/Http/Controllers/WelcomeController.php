<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bb;

class WelcomeController extends Controller
{
  public function index()
  {
    $bbs = Bb::all();
    return view('welcome', compact('bbs'));
  }
  public function store(Request $request)
  {
    $this->validate($request, [
            'image' => [
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
    ]);
    if ($request->file('image')->isValid([])) {
      $image = base64_encode(file_get_contents($request->image->getRealPath()));
      Bb::insert(["image" => $image]);
      return redirect('welcome')->with('message', '画像を投稿しました。');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
  }
}
