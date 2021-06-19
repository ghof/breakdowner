<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreakdownPostRequest extends FormRequest
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
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'time_expression' => ['regex:/^(([0-9]*[mdhis])(,[0-9]*[mdhis])*)*$/']
        ];
    }
}
