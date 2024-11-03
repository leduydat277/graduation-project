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
            'type.required' => 'Tên loại phòng là bắt buộc.',
            'type.string' => 'Tên loại phòng phải là chuỗi ký tự.',
            'type.max' => 'Tên loại phòng không được vượt quá 255 ký tự.',
        ];
    }
}
