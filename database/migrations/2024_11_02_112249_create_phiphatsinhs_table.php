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
        Schema::create('phiphatsinhs', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('booking_id'); // Trường booking_id
            $table->string('name'); // Tên phí phát sinh
            $table->text('description')->nullable(); // Mô tả (có thể để trống)
            $table->string('image')->nullable(); // Hình ảnh (có thể để trống)
            $table->unsignedBigInteger('price'); // Giá (với 2 chữ số thập phân)
            $table->unsignedInteger('status')->default(0); // Trạng thái 0 chưa thanh toán, 1 đã thanh toán
            $table->unsignedInteger('created_at')->default(time()); // Trường created_at kiểu unsignedInteger
            $table->unsignedInteger('updated_at')->default(time()); // Trường updated_at kiểu unsignedInteger
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phiphatsinh');
    }
};
