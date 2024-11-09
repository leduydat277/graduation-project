<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Thêm trường payment_status với comment để mô tả ý nghĩa
            $table->unsignedTinyInteger('payment_status')
                ->default(0)
                ->comment('0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn');
            $table->string('vnp_BankCode')->nullable();
            $table->text('vnp_TransactionNo')->nullable()->change();
            $table->unsignedInteger('updated_at')->default(time());
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Xóa các cột đã thêm nếu rollback
            $table->dropColumn(['payment_status','updated_at', 'vnp_BankCode', 'vnp_TransactionNo']);
        });
    }
};
