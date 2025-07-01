<?php

namespace Modules\HR\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$this->id.',uuid,deleted_at,NULL',
            'mobile' => 'required|string|regex:/^[0-9]{10,15}$/|unique:users,mobile,'.$this->id.',uuid,deleted_at,NULL',
            'gender_id' => 'nullable',
            'role_id' => 'required',
            'date_of_birth' => 'nullable|date',
            'nid' => 'required|integer|unique:users,nid,'.$this->id.',uuid,deleted_at,NULL',
            'salary' => 'nullable',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'ref_details' => 'nullable|string',
            'status' => 'required|integer|in:1,2',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
