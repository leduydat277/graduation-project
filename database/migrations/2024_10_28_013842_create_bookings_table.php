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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // ID người booking phòng
            $table->timestamp('check_in_date');
            $table->timestamp('check_out_date');
            $table->integer('VAT'); // Phần trăm thuế VAT
            $table->float('total_price'); // Tổng giá
            $table->integer('actual_number_people'); // Số lượng người thực tế
            $table->integer('surcharge')->nullable(); // Phụ phí
            $table->integer('deposit_amount')->nullable(); // Số tiền cọc
            $table->string('deposit_status', 50)->default('pending');
            // Trạng thái cọc: pending, paid, refunded
            $table->timestamp('deposit_date')->nullable(); // Ngày cọc tiền
            $table->timestamp('deposit_refund_date')->nullable(); // Ngày hoàn cọc
            $table->integer('type'); // 1 - Online, 2 - Tại quầy
            $table->timestamp('create_at')->useCurrent();
            $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
