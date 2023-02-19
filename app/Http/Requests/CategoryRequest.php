<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

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
            // Rule::unique('time_emps', 'emp_id')->ignore($this->timeemp)
            'name' => ['required', Rule::unique('categories', 'id')->ignore($this->name)],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Category booked',
            'image'=>'not valid image'
        ];
    }
}

