<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MakeServiceCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Đăng ký các command của ứng dụng.
     *
     * @var array
     */
    protected $commands = [
        MakeServiceCommand::class, // Thêm command mới của bạn vào đây
    ];

    /**
     * Xác định lịch trình các tác vụ.
     */
    protected function schedule(Schedule $schedule)
    {
        // Định nghĩa các tác vụ theo lịch trình ở đây
    }

    /**
     * Đăng ký các command dựa trên cấu hình.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
