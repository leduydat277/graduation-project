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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->unsignedBigInteger('booking_id'); // Trường booking_id để liên kết với bảng bookings
            $table->unsignedInteger('payment_date')->default(time())->comment('ngày thanh toán'); // Ngày thanh toán
            $table->unsignedBigInteger('total_price');
            $table->string('payment_method')->comment('0: tiền mặt, 1:chuyển khoản'); // Phương thức thanh toán
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
