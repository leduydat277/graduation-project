<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Thiết lập các quy tắc xác thực.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|max:255',
            'roomType_number' => 'required|unique:room_types,roomType_number,' . $this->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Tối đa 2MB
        ];
    }


    /**
     * Thiết lập thông báo lỗi tùy chỉnh (nếu cần).
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Validation cho 'type'
            'type.required' => 'Tên loại phòng là bắt buộc.',
            'type.string' => 'Tên loại phòng phải là chuỗi ký tự.',
            'type.max' => 'Tên loại phòng không được vượt quá 255 ký tự.',

            // Validation cho 'roomType_number'
            'roomType_number.required' => 'Mã loại phòng là bắt buộc.',
            'roomType_number.unique' => 'Mã loại phòng đã tồn tại.',

            // Validation cho 'image'
            'image.image' => 'Tệp được tải lên phải là một ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpg, jpeg, png hoặc webp.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ];
    }
}
