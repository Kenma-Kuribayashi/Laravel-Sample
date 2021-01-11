<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:50',
            'body' => 'required|max:100',
            'published_at' => 'required|date',
            'image' => 'file|image|mimes:jpeg,png',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.min' => 'タイトルは3文字以上、50文字以内で記入してください。',
            'title.max' => 'タイトルは3文字以上、50文字以内で記入してください。',
            'body.required' => '本文は必須です。',
            'body.max' => '本文は100文字以内で記入してください。',
            'published_at.required' => '記事の公開日は必須です。',
            'published_at.date' => '記事の公開日の形式が違います。',
            'image.file' => '画像はjpegかpngファイルを指定してください。',
            'image.image'  => '画像はjpegかpngファイルを指定してください。',
            'image.mimes'  => '画像はjpegかpngファイルを指定してください。',
        ];
    }
}
