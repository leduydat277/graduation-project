<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Cho phép thực hiện request này
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'room_type' => 'required|exists:room_types,id',
            'max_people' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'room_area' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên phòng là bắt buộc.',
            'room_type.required' => 'Loại phòng là bắt buộc.',
            'room_type.exists' => 'Loại phòng không hợp lệ.',
            'max_people.required' => 'Số người tối đa là bắt buộc.',
            'max_people.integer' => 'Số người tối đa phải là số nguyên.',
            'max_people.min' => 'Số người tối đa phải lớn hơn hoặc bằng 1.',
            'price.required' => 'Giá là bắt buộc.',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
            'room_area.required' => 'Diện tích là bắt buộc.',
            'room_area.numeric' => 'Diện tích phải là số.',
            'room_area.min' => 'Diện tích phải lớn hơn hoặc bằng 0.'
        ];
    }
}
