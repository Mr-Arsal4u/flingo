<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' This command is used to create a services file';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'), 0755, true);
        }

        $stub = $this->getServiceStub();
        $stub = str_replace('{{ className }}', $name, $stub);

        File::put($servicePath, $stub);

        $this->info("Service {$name} created successfully.");
    }

    protected function getServiceStub()
    {
        return <<<EOD
<?php

namespace App\Services;

class {{ className }}
{
    // Service methods go here
}

EOD;
    }
}
