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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('user_id'); // Khóa ngoại liên kết với bảng users
            $table->string('value'); // Giá trị của token
            $table->timestamp('expiry_time'); // Thời gian hết hạn của token
            $table->unsignedInteger('created_at')->default(time()); // Trường created_at kiểu unsignedInteger
            $table->unsignedInteger('updated_at')->default(time()); // Trường updated_at kiểu unsignedInteger
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
