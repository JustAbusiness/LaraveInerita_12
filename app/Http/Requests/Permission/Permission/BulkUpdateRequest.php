<?php

namespace App\Http\Requests\Permission\Permission;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
 
    public function rules(): array
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:permissions,id',
        ];
    }
}