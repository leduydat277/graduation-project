<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Sửa comment cho cột status
            $table->unsignedTinyInteger('status')
                ->comment('0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn, 4: đang sử dụng, 5: đã hủy')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Nếu cần, có thể đặt lại comment cũ (hoặc để nguyên nếu không yêu cầu rollback)
            $table->unsignedTinyInteger('status')->comment(null)->change();
        });
    }
};
