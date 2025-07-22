<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
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
        return 
            [
            'budget_datetime'   => 'required|date',
            'client'            => 'required|string|min:3|max:25',
            'seller'            => 'required|string|min:3|max:25',
            'description'       => 'required|string|min:5|max:10000',
            'estimated_value'   => 'required|numeric|min:0',
        
        ];
    }
}
