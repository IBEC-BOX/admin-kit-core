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
        $this->comment("Installing Admin Kit...\n");

        $this->info('Publishing configuration...');
        $this
            ->executeCommand('vendor:publish', [
                '--provider' => FoundationServiceProvider::class,
                '--tag' => ['orchid-assets'],
            ])
            ->executeCommand('vendor:publish', [
                '--provider' => CoreServiceProvider::class,
                '--tag' => ['admin-kit-config', 'admin-kit-stubs', 'admin-kit-migrations', 'admin-kit-assets'],
            ]);

        // php artisan storage:link
        if (! file_exists(public_path('storage'))) {
            if ($this->confirm('Add storage link?')) {
                $this->executeCommand('storage:link');
            }
        }

        // php artisan migrate
        if ($this->confirm('Migrate the database tables?')) {
            $this->executeCommand('migrate');
        }

        // php artisan orchid:admin
        if ($this->confirm('Create AdminUser?')) {
            $this->call('orchid:admin');
        }

        // set APP_URL environment
        $appUrl = $this->askToSetEnv('APP_URL', config('app.url'));

        // set DASHBOARD_PREFIX environment
        $prefix = $this->askToSetEnv('DASHBOARD_PREFIX', config('platform.prefix'));

        // completing the installation
        $this->info('Admin Kit success installed =)');

        $prefix = trim($prefix, "/ \t\n\r\0\x0B");
        $this->info("Open the dashboard using this link: <comment>$appUrl/$prefix<comment>");
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

    private function askToSetEnv(string $env, string $default = 'null'): string
    {
        $value = $this->ask("Set $env =", $default);
        if (! empty($value) && $value !== $default) {
            $this->setEnv($env, $value);
        }

        return $value;
    }

    private function setEnv(string $key, string $value = 'null'): self
    {
        $str = $this->fileGetContent(base_path('.env'));

        if ($str !== false && ! str_contains($str, $key)) {
            file_put_contents(base_path('.env'), $str.PHP_EOL.$key.'='.$value.PHP_EOL);
        } elseif ($str !== false && str_contains($str, $key)) {
            $collection = collect(file(base_path('.env')));
            $collection->transform(fn ($env) => str_contains(explode('=', $env)[0], $key) ? "$key=$value\n" : $env);
            file_put_contents(base_path('.env'), $collection->implode(''));
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
