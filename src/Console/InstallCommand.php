<?php

namespace AdminKit\Core\Console;

use AdminKit\Core\CoreServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'admin-kit:install';
    protected $description = 'Install all of the Admin Kit files';

    public function handle()
    {
        $this->comment('Installing Admin Kit...');
        $this->info('Publishing configuration...');

        $this
            ->executeCommand('vendor:publish', [
                '--provider' => CoreServiceProvider::class,
                '--tag' => [
                    'config',
                    'migrations',
                ],
            ])
            ->executeCommand('migrate')
            ->executeCommand('storage:link');

        $this->info('Installed Admin Kit');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "AdminKit\Core\CoreServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    private function executeCommand(string $command, array $parameters = []): self
    {
        try {
            $result = $this->callSilent($command, $parameters);
        } catch (\Exception $exception) {
            $result = 1;
            $this->alert($exception->getMessage());
        }

        if ($result) {
            $parameters = http_build_query($parameters, '', ' ');
            $parameters = str_replace('%5C', '/', $parameters);
            $this->alert("An error has occurred. The '{$command} {$parameters}' command was not executed");
        }

        return $this;
    }
}
