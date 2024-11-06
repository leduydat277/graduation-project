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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('user_id'); // Trường user_id
            $table->unsignedBigInteger('room_id'); // Trường room_id
            $table->integer('rating')->comment('max là 5 sao'); // Đánh giá (có thể là số nguyên)
            $table->text('comment')->nullable(); // Nhận xét (có thể để trống)
            $table->unsignedInteger('created_at')->default(time()); // Trường created_at kiểu unsignedInteger
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
