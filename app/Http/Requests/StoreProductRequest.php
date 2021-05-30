<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'reference' => 'required|string|size:16',
            'sizes' => ['required','array',Rule::in(['1','2','3','4','5'])],
            'categories' => 'required',
            'picture' => 'image',
            'is_discounted' => 'required|boolean',
            'is_published' => 'required|boolean'
        ];
    }

}
