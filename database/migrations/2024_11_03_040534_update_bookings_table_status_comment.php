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
                ->default(0)
                ->change();
            $table->string('code_check_in')
                ->nullable()
                ->change();
            $table->bigInteger('tien_coc')
                ->nullable()
                ->change();
            $table->bigInteger('total_price')->change();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Nếu cần, có thể đặt lại comment cũ (hoặc để nguyên nếu không yêu cầu rollback)
            $table->unsignedTinyInteger('status')->comment(null)->change();
            $table->string('code_check_in')
                ->change();
            $table->unsignedInteger('tien_coc')
                ->change();
            $table->integer('total_price')->change();
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->bigInteger('user_id');
        });
    }
};
