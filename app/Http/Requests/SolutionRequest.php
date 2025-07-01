<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolutionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'solution_category_id' => 'required|exists:solution_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'solution_category_id.required' => 'The solution category field is required.',
            'solution_category_id.exists' => 'The selected solution category is invalid.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 2MB.',
            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be true or false.',
        ];
    }
}
