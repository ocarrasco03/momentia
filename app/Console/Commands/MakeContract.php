<?php

namespace App\Console\Commands;

class MakeContract extends BaseFileGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name : The name of the contract class} {--test : Generate Pest test file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        [$className, $folderPath] = $this->normalizeName($this->argument('name'));

        $directory = app_path('Contracts/' . $folderPath);
        $filePath = $directory . '/' . $className . '.php';

        if (!$this->createDirectoryAndFile($directory, $filePath)) {
            return;
        }

        $namespace = 'App\\Contracts' . ($folderPath ? '\\' . str_replace('/', '\\', $folderPath) : '');
        $this->buildFileFromStub(
            __DIR__ . '/stubs/contract.stub',
            $filePath,
            $namespace,
            $className,
        );

        $this->info("Contract {$className} created successfully");

        if ($this->option('test')) {
            $this->generateTest($folderPath, $className, 'pest_contract_test.stub', 'Contracts');
        }
    }
}
