<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('room_type_id'); // Trường room_type_id để liên kết với bảng room_types
            $table->json('image_room')->comment("Các ảnh lưu dưới dạng json"); // Hình ảnh phòng (dạng JSON)
            $table->unsignedInteger('max_people')->comment('Số người tối đa của phòng'); // Số người tối đa
            $table->string('title')->comment("tên phòng, dùng để hiển thị tên thay vì id phòng ở phía FE"); // Tiêu đề phòng
            $table->unsignedBigInteger('price'); // Giá phòng
            $table->unsignedInteger('room_area')->comment('Diện tích phòng'); // Diện tích phòng
            $table->text('description')->nullable(); // Mô tả phòng (có thể để trống)
            $table->tinyInteger('status')->default('0')->comment('0: sẵn sàng, 1: đã cọc, 2: đang sử dụng, 3: hỏng. Admin sẽ có quyền tùy chỉnh'); // Trạng thái phòng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
