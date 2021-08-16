<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetStoreRequest extends FormRequest
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
            'neto' => ['numeric'],
            'iva' => ['numeric'],
            'total' => ['numeric'],
            'reference' => ['string'],
            'client_id' => ['required','numeric','exists:clients,id'],
            'user_id' => ['required','numeric','exists:users,id'],
            'products' => ['array','min:1'],
            'products.*.product_id' => ['required','exists:products,id'],
            'products.*.quantity' => ['required','min:1','numeric'],
            'products.*.product_price' => ['required','numeric'],
            'products.*.product_sku' => ['required'],
            'products.*.total' => ['required','numeric']

        ];
    }
}
