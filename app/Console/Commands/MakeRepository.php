<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository class at the specified path';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the path argument
        $path = $this->argument('path');

        // Base Repositories directory
        $baseDirectory = app_path('Repositories');

        // Full path including the Repositories directory
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
            $namespace = 'App\\Repositories' . '\\' . str_replace('/', '\\', dirname($path));
            $namespace = rtrim($namespace, '\\');

            File::put($fullPath, "<?php\n\nnamespace $namespace;\n\nclass $className\n{\n    // Repository methods\n}\n");
            $this->info("Repository created at: $fullPath");
        } else {
            $this->error("Repository already exists at: $fullPath");
        }
    }
}
