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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('room_id'); // Trường room_id
            $table->unsignedBigInteger('user_id'); // Trường user_id
            $table->string('code_check_in'); // Mã check-in
            $table->unsignedInteger('check_in_date'); // Ngày check-in (kiểu số)
            $table->unsignedInteger('check_out_date'); // Ngày check-out (kiểu số)
            $table->unsignedInteger('total_price'); // Tổng giá
            $table->unsignedInteger('tien_coc')->comment('cọc lấy 30% giá đơn'); // Tiền cọc (30%)
            $table->tinyInteger('status')->comment('0: đã cọc, 1: đang sử dụng, 2:đang thanh toán, 3: đã thanh toán, 4:đã hủy'); // Trạng thái
            $table->unsignedInteger('created_at')->default(time()); // Trường created_at kiểu unsignedInteger
            $table->unsignedInteger('updated_at')->default(time()); // Trường updated_at kiểu unsignedInteger
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
