<?php

namespace AdminKit\Core\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Process\Exceptions\ProcessFailedException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class ClonePackageCommand extends Command
{
    protected $signature = 'admin-kit:clone {url}';

    protected $description = 'Clone AdminKit package into composer-packages';

    public function handle(): void
    {
        $url = $this->argument('url');

        try {
            $packageName = $this->getPackageName($url);

            $destination = "composer-packages/ibecsystems/{$packageName}";

            if (! $this->hasPackage($destination)) {
                $this->comment("Cloning package...\n");
                $this->clonePackage($url, $destination);
            } else {
                $this->comment('Package already cloned. Skipping...');
            }

            if ($this->hasPHPStormConfig()) {
                if (! $this->hasDirectoryMapping($destination)) {
                    $this->comment("[PHPStorm] Adding Directory Mapping...\n");
                    $this->addDirectoryMapping($destination);
                } else {
                    $this->comment('[PHPStorm] Directory Mapping already added. Skipping...');
                }
            }

            $this->info("Package ready for development: {$destination}");
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function getPackageName(string $url): string
    {
        $repoName = explode('/', $url)[1] ?? null;

        if (! $repoName) {
            throw new Exception("Invalid repository url: {$url}");
        }

        if (str_contains($repoName, '.git')) {
            $repoName = str_replace('.git', '', $repoName);
        }

        if (! is_string($repoName)) {
            throw new Exception("Error while parsing repository url: {$url}");
        }

        return $repoName;
    }

    private function hasPackage(string $destination): bool
    {
        return File::isDirectory(base_path($destination));
    }

    /**
     * @throws Exception
     */
    private function clonePackage(string $url, string $destination): void
    {
        try {
            Process::run("git clone {$url} {$destination}")
                ->throw();
        } catch (ProcessFailedException $e) {
            throw new Exception('Cannot clone package: '.$e->getMessage());
        }
    }

    private function hasPHPStormConfig(): bool
    {
        return File::isDirectory(base_path('.idea'));
    }

    /**
     * @throws Exception
     */
    private function hasDirectoryMapping(string $destination): bool
    {
        $vcsPath = base_path('.idea/vcs.xml');

        $xml = simplexml_load_file($vcsPath);

        $mapping = $xml->xpath("//mapping[@directory='\$PROJECT_DIR\$/{$destination}']");

        return (bool) $mapping;
    }

    private function addDirectoryMapping(string $destination): void
    {
        $vcsPath = base_path('.idea/vcs.xml');

        $xml = simplexml_load_file($vcsPath);

        $components = $xml->xpath('//component[@name="VcsDirectoryMappings"]');

        $mapping = $components[0]->addChild('mapping');
        $mapping->addAttribute('directory', "\$PROJECT_DIR\$/{$destination}");
        $mapping->addAttribute('vcs', 'Git');

        $xml->asXML($vcsPath);
    }
}
