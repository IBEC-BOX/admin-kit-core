<?php

namespace AdminKit\Core\Commands;

use AdminKit\Core\CoreServiceProvider;
use Illuminate\Console\Command;
use Orchid\Platform\Providers\FoundationServiceProvider;

class InstallCommand extends Command
{
    protected $signature = 'admin-kit:install';

    protected $description = 'Install all of the AdminKit package';

    public function handle()
    {
        $this->comment('Installing Admin Kit...');

        $this->info('Publishing configuration...');
        $this
            ->executeCommand('vendor:publish', [
                '--provider' => FoundationServiceProvider::class,
                '--tag' => ['orchid-assets'],
            ])
            ->executeCommand('vendor:publish', [
                '--provider' => CoreServiceProvider::class,
                '--tag' => ['admin-kit-config', 'admin-kit-stubs', 'admin-kit-migrations', 'admin-kit-assets'],
            ])
            ->executeCommand('storage:link')
            ->setValueEnv('SCOUT_DRIVER');

        if ($this->confirm('Migrate the database tables?', true)) {
            $this->executeCommand('migrate');
        }

        if ($this->confirm('Create AdminUser?', true)) {
            $this->call('orchid:admin');
        }

        $this->info('Admin Kit success installed =)');
        $this->comment('Follow this link: ' . asset(config('platform.prefix')));
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

    private function setValueEnv(string $constant, string $value = 'null'): self
    {
        $str = $this->fileGetContent(app_path('../.env'));

        if ($str !== false && strpos($str, $constant) === false) {
            file_put_contents(app_path('../.env'), $str.PHP_EOL.$constant.'='.$value.PHP_EOL);
        }

        return $this;
    }

    private function fileGetContent(string $file)
    {
        if (! is_file($file)) {
            return '';
        }

        return file_get_contents($file);
    }
}
