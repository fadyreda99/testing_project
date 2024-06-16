<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service class at the specified path';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the path argument
        $path = $this->argument('path');

        // Base Services directory
        $baseDirectory = app_path('Services');

        // Full path including the Services directory
        $fullPath = $baseDirectory . '/' . str_replace('\\', '/', $path) . '.php';

        // Extract the directory from the full path
        $directory = dirname($fullPath);

        // Ensure the directory exists
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info("Directory created at: $directory");
        } else {
            $this->info("Directory already exists at: $directory");
        }

        // Create the file if it doesn't exist
        if (!File::exists($fullPath)) {
            $className = basename($path);
            $namespace = 'App\\Services' . '\\' . str_replace('/', '\\', dirname($path));
            $namespace = rtrim($namespace, '\\');

            File::put($fullPath, "<?php\n\nnamespace $namespace;\n\nclass $className\n{\n    // Service methods\n}\n");
            $this->info("Service created at: $fullPath");
        } else {
            $this->error("Service already exists at: $fullPath");
        }
    }
}
