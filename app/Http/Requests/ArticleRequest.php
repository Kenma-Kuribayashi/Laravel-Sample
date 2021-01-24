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
          'tag_id' => 'required|int',
          'image' => 'file|image|mimes:jpeg,png',
        ];
    }
}
