<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetStatusStoreRequest extends FormRequest
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
                    'name' =>  request()->method() =='PUT' ?  ['required', 'max:30', "unique:budget_statuses,name,{$this->budget_status->id},id"] :  ['required', 'max:30', 'unique:budget_statuses,name'],
                    'color' => request()->method() =='PUT' ? ['required', "unique:budget_statuses,color,{$this->budget_status->id},id"] : ['required', 'unique:budget_statuses,color']
                ];


    }
}
