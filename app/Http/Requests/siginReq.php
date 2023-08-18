<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class siginReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'min:3|unique:users|required',
            'email'=>'min:10|unique:users|required',
            'password'=>'min:5|required',
            'bio'=>"min:20 |required",
            'image_url'=>"min:5"
        ];
    }
}
