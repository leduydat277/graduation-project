<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Đảm bảo bạn trả về true để request này có thể được sử dụng
    }

    public function rules()
    {
        return [
            'cccd' => 'required|digits:12', // CCCD phải đủ 12 chữ số
            'room_id' => 'required|exists:rooms,id', // Phải chọn một phòng có trong danh sách phòng
            'actual_number_people' => 'required|integer|min:1', // Số người thực tế phải là số nguyên >= 1
        ];
    }

    public function messages()
    {
        return [
            'cccd.required' => 'Vui lòng nhập số CCCD.',
            'cccd.digits' => 'Số CCCD phải có đúng 12 chữ số.',
            'room_id.required' => 'Vui lòng chọn phòng.',
            'room_id.exists' => 'Phòng không hợp lệ.',
            'actual_number_people.required' => 'Vui lòng nhập số lượng người thực tế.',
            'actual_number_people.integer' => 'Số lượng người thực tế phải là số nguyên.',
            'actual_number_people.min' => 'Số lượng người thực tế phải lớn hơn hoặc bằng 1.',
        ];
    }
}
