<?php
namespace App\Http\API\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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

    /**
     * @return array
     */
    public function convert(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'publishedAt' => $this->published_at,
            'tagId' => $this->tag_id,
            'image' => $this->image,
            'articleId' => $this->article->id,
        ];
    }
}
