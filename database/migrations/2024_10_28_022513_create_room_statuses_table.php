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
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id'); // id phòng
            $table->integer('status_id'); // Trạng thái của phòng
            $table->text('description'); // Mô tả tình trạng cụ thể
            $table->integer('user_id'); // Người báo cáo tình trạng
            $table->timestamp('create_at')->nullable(); // Thời gian tạo
            $table->timestamp('update_at')->nullable(); // Thời gian cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_statuses');
    }
};
