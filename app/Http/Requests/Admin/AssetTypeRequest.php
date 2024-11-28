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
        return true; // Cho phép người dùng sử dụng request này
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên loại tiện nghi là bắt buộc.',
            'name.string' => 'Tên loại tiện nghi phải là một chuỗi.',
            'name.max' => 'Tên loại tiện nghi không được vượt quá 255 ký tự.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'image.image' => 'Tệp phải là một hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ];
    }
}
