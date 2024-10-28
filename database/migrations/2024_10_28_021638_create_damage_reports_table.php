<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('damage_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id'); // ID phòng
            $table->integer('status_id'); // Trạng thái của phòng
            $table->integer('user_id'); // Người báo cáo tình trạng phòng
            $table->integer('booking_id'); // ID đơn hàng liên quan
            $table->text('damage_type'); // Loại hỏng hóc
            $table->integer('compensation_amount')->nullable(); // Số tiền đền bù nếu có
            $table->text('description')->nullable(); // Mô tả chi tiết tình trạng hỏng
            $table->timestamp('reported_at')->useCurrent(); // Thời gian báo cáo
            $table->boolean('resolved_at')->default(0); // Đã giải quyết chưa: 0-Chưa, 1-Đã giải quyết
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_reports');
    }
};
