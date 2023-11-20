<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyEditValidationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required','email',Rule::unique('companies')->ignore($this->company),],
            'logo' => 'image|mimes:jpg,jpeg,png,gif|dimensions:max_width=100,max_height=100',
            'website' => 'max:255',
        ];
    }
}
