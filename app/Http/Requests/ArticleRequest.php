<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;


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

    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'errors' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($res);
    }

    /**
     * @return Collection
     */
    public function convert(): Collection
    {
        return collect([
            'title' => $this->title,
            'body' => $this->body,
            'publishedAt' => $this->published_at,
            'tagId' => $this->tag_id,
            'image' => $this->image,
            'articleId' => $this->article->id,
        ]);
    }
}
