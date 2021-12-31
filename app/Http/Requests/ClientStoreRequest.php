<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
        $uniqueRule = $this->method() === 'PUT' ? '' : 'unique:clients';
        return [
            'name' => ['required', 'string', 'max:255'],
            'rut' => ['nullable', 'string', 'max:20',$uniqueRule,'cl_rut'],
            'address' => ['string','nullable'],
            'phone' => ['string','nullable'],
            'email' => ['email','nullable'],
            'type' => ['in:persona,empresa'],
            'draft' => ['string','nullable']
        ];
    }
}
