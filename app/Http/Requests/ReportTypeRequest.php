<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportTypeRequest extends FormRequest
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
            'name' => 'required|string|max:159',
            'confirmed_icon' => 'required|url|string|max:255', 
            'unconfirmed_icon' => 'required|url|string|max:255', 
            'menu_icon' => 'required|url|string|max:255', 
            'alive' => 'required|numeric',
        ];
    }
}
