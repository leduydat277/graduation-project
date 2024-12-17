<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImageRoomNullableInRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->json('image_room')
                ->nullable()
                ->default(null)
                ->comment('Các ảnh lưu dưới dạng json')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Chuyển cột về kiểu string (hoặc kiểu ban đầu)
            $table->string('image_room')->nullable()->change();
        });
    }
}
