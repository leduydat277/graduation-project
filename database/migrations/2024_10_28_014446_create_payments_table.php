<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id'); // ID booking
            $table->integer('status_id'); // Trạng thái của thanh toán
            $table->integer('amount'); // Số tiền thanh toán
            $table->timestamp('payment_date')->useCurrent(); // Thời gian thanh toán
            $table->integer('payment_method'); // Phương thức thanh toán: 1-Tiền mặt, 2-Chuyển khoản
            $table->string('code')->nullable(); // Mã giao dịch từ cổng thanh toán (cho phép nullable)
            $table->json('payment_gateway_response')->nullable(); // Dữ liệu phản hồi từ cổng thanh toán (cho phép nullable)
            $table->timestamp('create_at')->useCurrent(); // Thời gian tạo
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate(); // Thời gian cập nhật
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
