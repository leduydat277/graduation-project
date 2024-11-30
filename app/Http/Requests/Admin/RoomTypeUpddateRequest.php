<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeUpddateRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'roomType_number' => 'required|string|unique:room_types,roomType_number,' . $this->route('room_type'),
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Ảnh tối đa 2MB
        ];
    }
    /**
     * Custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'Tên loại phòng là bắt buộc.',
            'type.string' => 'Tên loại phòng phải là chuỗi ký tự.',
            'type.max' => 'Tên loại phòng không được vượt quá 255 ký tự.',
            'roomType_number.required' => 'Mã loại phòng là bắt buộc.',
            'roomType_number.unique' => 'Mã loại phòng đã tồn tại.',
            'image.image' => 'Tệp được tải lên phải là một ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpg, jpeg, png hoặc webp.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ];
    }
}
