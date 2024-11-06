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
        Schema::create('manage_status_rooms', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('booking_id')->comment("để truy vấn dễ hơn"); // Trường booking_id
            $table->unsignedBigInteger('room_id'); // Trường room_id
            $table->tinyInteger('status')->comment('0: đã cọc, 1: sẵn sàng, 2: đang sử dụng, 3: đang thanh toán'); // Trạng thái
            $table->unsignedInteger('date_in'); // Ngày vào (kiểu số, mặc định 0)
            $table->unsignedInteger('date_out')->comment('Lấy số 0 làm cờ'); // Ngày ra (kiểu số, mặc định 0)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_status_rooms');
    }
};