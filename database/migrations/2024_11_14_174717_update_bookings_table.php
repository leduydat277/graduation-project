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
        Schema::table('bookings', function (Blueprint $table) {
            // Cập nhật kiểu dữ liệu của check_in_date và check_out_date
            $table->date('check_in_date')->nullable()->change();
            $table->date('check_out_date')->nullable()->change();
            $table->date('created_at')->nullable()->change();
            $table->date('updated_at')->nullable()->change();

            // Cập nhật cột code_check_in nếu cột đã tồn tại (nếu không cần phải xóa)
            if (!Schema::hasColumn('bookings', 'code_check_in')) {
                $table->string("code_check_in")->nullable();
            }

            // Cập nhật cột tien_coc nếu cột đã tồn tại (nếu không cần phải xóa)
            if (!Schema::hasColumn('bookings', 'tien_coc')) {
                $table->integer("tien_coc")->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Khôi phục các thay đổi trong phương thức up
            $table->integer('check_in_date')->change();
            $table->integer('check_out_date')->change();
            $table->dropColumn('code_check_in');
            $table->dropColumn('tien_coc');
            $table->integer('created_at')->nullable()->change();
            $table->integer('updated_at')->nullable()->change();
        });
    }
};
