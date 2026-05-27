<?php

namespace App\Console\Commands;

use App\Traits\HasGenerate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSingleModule extends Command
{
    use HasGenerate;
    private $module;
    private $namespace;
    private $version;
    private $table;
    private $moduleName;
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'make:crud {module} {--namespace=} {--ver=} {--table=} {--moduleName=}';
    /**
     * The console command description. 
     *
     * @var string
     */
    protected $description = 'Command description';

    protected function setModule(string $module = ''): static
    {
        $this->module = $module;
        return $this;
    }

    protected function setNamespace(string $namespace = ''): static
    {
        $this->namespace = $namespace;
        return $this;
    }

    protected function setVersion(string $version = 'V1'): static
    {
        $this->version = $version;
        return $this;
    }

    protected function setTable(string $table = ''): static
    {
        $this->table = $table;
        return $this;
    }

    protected function setModuleName(string $moduleName = ''): static
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    /**
     * Execute the console command. 
     */
    public function handle()
    {
        try {
            $this->setModule($this->argument('module'))
                ->setNamespace($this->option('namespace'))
                ->setVersion($this->option('ver'))
                ->setTable($this->option('table'))
                ->setModuleName($this->option('moduleName'))
                ->generateModel()
                ->generateController()
                ->generateRequest()
                ->generateService()
                ->generateRepository()
                ->generateMigration();
                // ->generatePermissionData();

            return \Symfony\Component\Console\Command\Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Error: ' . $th->getMessage());
            return \Symfony\Component\Console\Command\Command::FAILURE;
        }
    }

    private function generateRequest(): static
    {
        $target = app_path("Http/Requests/{$this->namespace}/{$this->module}");
        $stub =  [
            'bulk-destroy-request' => 'BulkDestroyRequest',
            'bulk-update-request' => 'BulkUpdateRequest',
            'store-request' => 'StoreRequest' ,
            'update-request' => 'UpdateRequest'
        ]; 

        foreach ($stub as $key => $stub) {
            $stubContent = $this->getStubs("common/{$key}");
            $description = "{$target}/{$stub}.php";
            $content = $this->getContent($stubContent);
            File::ensureDirectoryExists($target);
            $this->put($description, $content);
        }      
        return $this;
    } 
}
