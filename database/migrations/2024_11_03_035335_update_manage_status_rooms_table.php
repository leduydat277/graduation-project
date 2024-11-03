<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('manage_status_rooms', function (Blueprint $table) {
            // Đổi tên các cột
            $table->renameColumn('date_in', 'from');
            $table->renameColumn('date_out', 'to');

            // Cập nhật comment của cột 'status' để giải thích các giá trị trạng thái
            $table->integer('status')
                ->comment('0: đã cọc, 1: sẵn sàng, 2: đang sử dụng')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('manage_status_rooms', function (Blueprint $table) {
            $table->renameColumn('from', 'date_in');
            $table->renameColumn('to', 'date_out');

            $table->integer('status')->change();

            $table->comment(null);
        });
    }
};
