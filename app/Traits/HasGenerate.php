<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait HasGenerate
{
    private function getStubs(string $filePath = '')
    {
        return File::get(resource_path("stubs/{$filePath}.stub"));
    }

    private function put($destination, $content)
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
                ...(isset($extend[0])) ? $extend[0] : [],
            ],
            [
                $this->namespace,
                $this->module,
                $this->version,
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
}
