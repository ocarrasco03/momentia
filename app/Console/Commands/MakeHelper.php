<?php

namespace App\Console\Commands;

class MakeHelper extends BaseFileGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name : The name of the helper class} {--test : Generate Pest test file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new helper class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        [$className, $folderPath] = $this->normalizeName($this->argument('name'));

        $directory = app_path('Helpers/' . $folderPath);
        $filePath = $directory . '/' . $className . '.php';

        if (!$this->createDirectoryAndFile($directory, $filePath)) {
            return;
        }

        $namespace = 'App\\Helpers' . ($folderPath ? '\\' . str_replace('/', '\\', $folderPath) : '');
        $this->buildFileFromStub(
            __DIR__ . '/stubs/helper.stub',
            $filePath,
            $namespace,
            $className,
        );

        $this->info("Helper {$className} created successfully");

        if ($this->option('test')) {
            $this->generateTest($folderPath, $className, 'pest_test.stub', 'Helpers');
        }
    }
}
