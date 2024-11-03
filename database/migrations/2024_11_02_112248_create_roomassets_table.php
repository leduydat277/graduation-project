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
        Schema::create('roomassets', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('assets_type_id'); // Trường assets_type_id để liên kết với bảng assets_types
            $table->unsignedBigInteger('room_id'); // Trường room_id để liên kết với bảng rooms
            $table->tinyInteger('status')->default(0)->comment('0: đang sử dụng, 1: tạm dừng sử dụng'); // Trạng thái (0: active, 1: unactive)
            $table->unsignedInteger('created_at')->default(time()); // Trường created_at kiểu unsignedInteger
            $table->unsignedInteger('updated_at')->default(time()); // Trường updated_at kiểu unsignedInteger
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomassets');
    }
};