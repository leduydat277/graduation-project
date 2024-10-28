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
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id'); // ID booking phòng
            $table->integer('room_id'); // ID phòng
            $table->integer('room_type_id'); // Số loại phòng
            $table->string('CCCD', 12); // Số CCCD của người đặt (1 phòng chỉ cần 1 CCCD)
            $table->integer('actual_number_people'); // Số lượng người đến thực tế
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
        Schema::dropIfExists('detail_bookings');
    }
};
