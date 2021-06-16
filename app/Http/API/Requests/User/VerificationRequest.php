<?php


namespace App\Http\API\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest
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
            'id' => 'required|int',
        ];
    }

    /**
     * @return array
     */
    public function convert(): array
    {
        $user = $this->user();
        return [
            'id' => $this->id,
            'user' => $user,
        ];
    }
}
