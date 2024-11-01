<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    // Định nghĩa lệnh mới
    protected $signature = 'make:service {name : The name of the service}';
    protected $description = 'Create a new service class';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy tên service từ đối số
        $name = $this->argument('name');

        // Định nghĩa đường dẫn đầy đủ cho service mới
        $servicePath = app_path('Services/' . str_replace('\\', '/', $name) . '.php');

        // Kiểm tra xem file đã tồn tại chưa
        if (File::exists($servicePath)) {
            $this->error('Service already exists!');
            return;
        }

        // Tạo thư mục chứa service nếu chưa tồn tại
        File::ensureDirectoryExists(dirname($servicePath));

        // Chuẩn bị nội dung của file service
        $className = Str::afterLast($name, '\\');
        $namespace = 'App\\Services' . (dirname($name) ? '\\' . str_replace('/', '\\', dirname($name)) : '');

        $content = "<?php

namespace $namespace;

class $className
{
    // Implement service logic here
}";

        // Tạo file service mới
        File::put($servicePath, $content);

        // Hiển thị thông báo thành công
        $this->info('Service created successfully at ' . $servicePath);
    }
}
