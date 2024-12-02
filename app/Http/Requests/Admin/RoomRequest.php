<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'roomId_number' => 'required|string|max:255|unique:rooms,roomId_number,' . $this->room, // Bỏ qua unique check cho phòng hiện tại khi cập nhật
            'room_type' => 'required|exists:room_types,id',
            'price' => 'required|numeric|min:0',
            'room_area' => 'required|numeric|min:0',
            'max_people' => 'required|integer|min:1',
            'image_room.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Thêm validation cho thumbnail
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên phòng là bắt buộc.',
            'title.unique' => 'Tên phòng đã tồn tại.',
            'roomId_number.required' => 'Mã phòng là bắt buộc.',
            'roomId_number.unique' => 'Mã phòng đã tồn tại.',
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
            'room_area.min' => 'Diện tích phải lớn hơn hoặc bằng 0.',
            'image_room.*.image' => 'Từng file phải là một hình ảnh.',
            'image_room.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, hoặc webp.',
            'image_room.*.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
            'thumbnail_image.image' => 'Ảnh thu nhỏ phải là một hình ảnh.',
            'thumbnail_image.mimes' => 'Ảnh thu nhỏ phải có định dạng jpeg, png, jpg, hoặc webp.',
            'thumbnail_image.max' => 'Dung lượng ảnh thu nhỏ không được vượt quá 2MB.',
        ];
    }
}
