<?php

namespace App\Http\Requests\User\UserCatalogue;

use Illuminate\Foundation\Http\FormRequest;

class BulkDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
             'ids' => 'required|array',
             'ids.*' => 'exists:user_catalogues,id'
        ]; 
    }

    public function messages(): array
    {
        return [
            'ids.required' => 'Vui lòng chọn danh mục cần xóa.',
            'ids.array' => 'Danh sách danh mục không hợp lệ.',
            'ids.*.exists' => 'Danh mục cần xóa không tồn tại.'
        ];
    }
}
