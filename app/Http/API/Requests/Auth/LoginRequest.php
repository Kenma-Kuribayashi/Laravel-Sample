<?php


namespace App\Http\API\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'email|required',
            'password' => 'required|min:4',
        ];
    }

    /**
     * @return array
     */
    public function convert(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
