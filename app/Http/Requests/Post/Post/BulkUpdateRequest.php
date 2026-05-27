<?php

namespace App\Http\Requests\Post\Post;

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
            'ids.*' => 'exists:posts,id',
        ];
    }
}