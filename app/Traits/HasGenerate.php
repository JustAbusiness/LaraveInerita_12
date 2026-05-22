<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait HasGenerate
{
    private function getStubs(string $filePath = '')
    {
        return File::get(resource_path("stubs/{$filePath}.stub"));
    }

    private function put(string $destination, string $content)
    {
        if (!File::exists($destination)) {
            File::put($destination, $content);
        }
        return $this;
    }

    private function getContent(string $content, ?array $extend = [])
    {
        $newContent = str_replace(
            [
                '{{namespace}}',
                '{{module}}',
                '{{version}}',
                '{{table}}',
                ...(isset($extend[0])) ? $extend[0] : [],
            ],
            [
                $this->namespace,
                $this->module,
                $this->version,
                $this->table,
                ...(isset($extend[1])) ? $extend[1] : [],
            ],
            $content
        );
        return $newContent;
    }

    private function generateController()
    {
        $stub = $this->getStubs('controller');
        $target = app_path("Http/Controllers/Backend/{$this->version}/{$this->namespace}");
        $destination = "{$target}/{$this->module}Controller.php";
        File::ensureDirectoryExists($target);

        $content = $this->getContent($stub);
        $this->put($destination, $content);
        return $this;
    }

    private function generateModel(): static
    {
        $stub = $this->getStubs('model');
        $target = app_path("Models");
        $destination = "{$target}/{$this->module}.php";
        File::ensureDirectoryExists($target);

        $content = $this->getContent($stub);
        $this->put($destination, $content);
        return $this;
    }

    private function generateService(): static
    {
        // Generate Service Interface
        $interfaceStub = $this->getStubs('service-interface');
        $interfaceTarget = app_path("Services/Interfaces/{$this->namespace}");
        $interfaceDestination = "{$interfaceTarget}/{$this->module}ServiceInterface.php";
        File::ensureDirectoryExists($interfaceTarget);

        $interfaceContent = $this->getContent($interfaceStub);
        $this->put($interfaceDestination, $interfaceContent);

        // Generate Service Implementation
        $serviceStub = $this->getStubs('service');
        $serviceTarget = app_path("Services/Impl/{$this->version}/{$this->namespace}");
        $serviceDestination = "{$serviceTarget}/{$this->module}Service.php";
        File::ensureDirectoryExists($serviceTarget);

        $serviceContent = $this->getContent($serviceStub);
        $this->put($serviceDestination, $serviceContent);

        return $this;
    }

    private function generateRepository(): static
    {
        $stub = $this->getStubs('repository');
        $target = app_path("Repositories/{$this->namespace}");
        $destination = "{$target}/{$this->module}Repo.php";
        File::ensureDirectoryExists($target);

        $content = $this->getContent($stub);
        $this->put($destination, $content);
        return $this;
    }
}
