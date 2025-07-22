<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetRequest extends FormRequest
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
            'budget_datetime'   => 'sometimes|required|date',
            'client'            => 'sometimes|required|string|min:3|max:25',
            'seller'            => 'sometimes|required|string|min:3|max:25',
            'description'       => 'nullable|string|min:5|max:10000',
            'estimated_value'   => 'sometimes|required|numeric|min:0',
        ];
    }
}
