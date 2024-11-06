<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AssetTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cho phép sử dụng request này
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Trường name là bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'description' => 'nullable|string', // Trường description có thể bỏ qua, kiểu chuỗi
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên loại tiện nghi là bắt buộc.',
            'name.string' => 'Tên loại tiện nghi phải là chuỗi ký tự.',
            'name.max' => 'Tên loại tiện nghi không được vượt quá 255 ký tự.',
            'description.string' => 'Mô tả loại tiện nghi phải là chuỗi ký tự.',
        ];
    }
}
