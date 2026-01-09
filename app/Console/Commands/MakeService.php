<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends BaseFileGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : The name of the service class} {--contract : Create a contract interface for the service} {--test : Generate Pest test file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        [$className, $folderPath] = $this->normalizeName($this->argument('name'));

        $directory = app_path('Services/' . $folderPath);
        $filePath  = $directory . '/' . $className . '.php';

        if (!$this->createDirectoryAndFile($directory, $filePath)) {
            return;
        }

        $namespace = 'App\\Services' . ($folderPath ? '\\' . str_replace('/', '\\', $folderPath) : '');
        $this->buildFileFromStub(
            __DIR__ . '/stubs/service.stub',
            $filePath,
            $namespace,
            $className,
        );

        $this->info("Service {$className} created successfully");

        if ($this->option('contract')) {
            $this->call('make:contract', ['name' => $this->argument('name')]);
        }

        if ($this->option('test')) {
            $this->generateTest($folderPath, $className, 'pest_test.stub', 'Services');
        }
    }
}
