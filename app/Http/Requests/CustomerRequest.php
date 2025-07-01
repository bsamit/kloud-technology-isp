<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$this->id.',uuid,deleted_at,NULL',
            'mobile' => 'required|string|regex:/^[0-9]{10,15}$/|unique:users,mobile,'.$this->id.',uuid,deleted_at,NULL',
            'gender_id' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'nid' => 'required|integer|unique:users,nid,'.$this->id.',uuid,deleted_at,NULL',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'address' => 'required|string|max:255',
        ];
    }
}
