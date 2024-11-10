<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('manage_status_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('manage_status_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable(false)->default(0)->change();
        });
    }
};
