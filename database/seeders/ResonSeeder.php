<?php

namespace Database\Seeders;

use App\Models\Reson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reson::create(['reson' => 'Khách thay đổi kế hoạch']);
        Reson::create(['reson' => 'Khách không thể đến đúng ngày']);
        Reson::create(['reson' => 'Khách gặp sự cố gia đình']);
        Reson::create(['reson' => 'Khách không hài lòng với dịch vụ']);
        Reson::create(['reson' => 'Khách chọn lựa khách sạn khác']);
        Reson::create(['reson' => 'Khách có vấn đề về sức khỏe']);
        Reson::create(['reson' => 'Khách hủy do sự cố cá nhân']);
        Reson::create(['reson' => 'Khách không đủ tài chính']);
        Reson::create(['reson' => 'Khách thay đổi địa điểm nghỉ dưỡng']);
        Reson::create(['reson' => 'Khách bị sự cố ngoài ý muốn']);
    }
}
