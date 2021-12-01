<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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

        switch ($this->method()) {
            case 'POST':

                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'unique:users'],
                    'area' => ['required', 'string'],
                    'password' => [
                        'required', 'confirmed',
                        Password::min(8)->letters(1)
                            ->mixedCase(1)
                            ->numbers(1)
                    ],
                    'phone' => ['required','string'],
                    'role' => ['required', 'exists:roles,id'],
                ];



            case 'PATCH':
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', "unique:users,id,{$this->user->id}"],
                    'area' => ['required', 'string'],
                    'phone' => ['required','string'],
                    'password' => [
                        'nullable',
                        'confirmed',
                        Password::min(8)->letters(1)
                            ->mixedCase(1)
                            ->numbers(1)
                    ],
                    'role' => ['exists:roles,id'],
                ];


        }
    }
}
