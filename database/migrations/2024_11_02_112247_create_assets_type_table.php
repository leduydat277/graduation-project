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
        Schema::create('assets_types', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('name')->comment('loại tiện nghi'); // Tên loại tài sản
            $table->text('description')->nullable()->comment("mô tả loại tiện ích"); // Mô tả loại tài sản (có thể để trống)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_type');
    }
};
