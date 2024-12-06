<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cho phép yêu cầu này được thực hiện
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id', // Phải có và tồn tại trong bảng rooms
            'assets_type_id' => 'required|array|min:1', // Phải là mảng và có ít nhất 1 phần tử
            'assets_type_id.*' => 'exists:assets_types,id', // Từng giá trị phải tồn tại trong bảng assets_types
            'status' => 'required|in:0,1', // Phải có và giá trị là 0 hoặc 1
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
            'room_id.required' => 'Vui lòng chọn phòng.',
            'room_id.exists' => 'Phòng không tồn tại.',
            'assets_type_id.required' => 'Vui lòng chọn ít nhất một loại tiện nghi.',
            'assets_type_id.array' => 'Loại tiện nghi phải là một mảng.',
            'assets_type_id.*.exists' => 'Loại tiện nghi không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ. Vui lòng chọn Đang sử dụng hoặc Tạm dừng sử dụng.',
        ];
    }
}
