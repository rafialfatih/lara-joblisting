<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListingRequest extends FormRequest
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
            'title' => ['required'],
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'website' => ['required'],
            'email' => ['required', 'email'],
            'tags' => ['required'],
            'description' => ['required'],
        ];
    }
}
