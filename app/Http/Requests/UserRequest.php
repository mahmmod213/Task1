<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required_without:id',
            'image' =>  'required_without:id|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('aside.required'),
            'email.required' => __('aside.required'),
            'email.email' => __('aside.email'),
            'email.unique' => __('aside.unique'),
            'password.required' => __('aside.required'),
            'image.required_without' => __('aside.required_without'),
            'image.image' => __('aside.image'),
            'image.mimes' => __('aside.mimes'),
        ];
    }
}
