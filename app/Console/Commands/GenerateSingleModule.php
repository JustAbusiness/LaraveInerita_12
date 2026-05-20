<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\HasGenerate;

class GenerateSingleModule extends Command
{
    use HasGenerate;
    private $module;
    private $namespace;
    private $version;
    private $table;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {module} {--namespace=} {--ver=} {--table=}';
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
                ->generateController();

            return \Symfony\Component\Console\Command\Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Error: ' . $th->getMessage());
            return \Symfony\Component\Console\Command\Command::FAILURE;
        }
    }
}
