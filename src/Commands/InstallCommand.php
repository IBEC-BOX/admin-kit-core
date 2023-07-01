<?php

namespace AdminKit\Core\Commands;

use AdminKit\Core\CoreServiceProvider;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'admin-kit:install';

    protected $description = 'Install all of the AdminKit package';

    public function handle()
    {
        $this->comment("Installing Admin Kit...\n");

        // publish configuration
        if ($this->confirm('Publishing configurations and files?', true)) {
            $this->call('vendor:publish', [
                '--tag' => ['filament-config'],
            ]);
            $this->call('vendor:publish', [
                '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            ]);
            $this->call('vendor:publish', [
                '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
                '--tag' => 'migrations',
            ]);
            $this->call('vendor:publish', [
                '--provider' => CoreServiceProvider::class,
                '--tag' => ['admin-kit-config', 'admin-kit-stubs', 'admin-kit-migrations'],
            ]);
        }

        // php artisan storage:link
        if (! file_exists(public_path('storage'))) {
            if ($this->confirm('Add storage link?', true)) {
                $this->call('storage:link');
            }
        }

        // php artisan migrate
        if ($this->confirm('Migrate the database tables?', true)) {
            $this->call('migrate');
        }

        // php artisan shield:generate --all
        if ($this->confirm('Generate the user Policies and Permissions?', true)) {
            $this->call('shield:generate', ['--all' => true]);
        }

        // set APP_URL environment
        $appUrl = $this->askToSetEnv(['APP_URL'], config('app.url'));

        // set FILAMENT_AUTH_GUARD to "admin-kit-web"
        $guard = $this->choiceToSetEnv([
            'FILAMENT_IMPERSONATE_GUARD',
            'FILAMENT_AUTH_GUARD',
        ], ['admin-kit-web', 'web']);

        // set FILAMENT_PATH environment
        $prefix = $this->askToSetEnv([
            'FILAMENT_IMPERSONATE_REDIRECT',
            'FILAMENT_PATH',
        ], config('filament.path'));

        // completing the installation
        $this->info('Admin Kit has been successfully installed =)');
        $this->info('To create a user, run: <comment>php artisan make:filament-user</comment>');
        $this->info('To start the embedded server, run: <comment>php artisan serve</comment>');

        $prefix = trim($prefix, "/ \t\n\r\0\x0B");
        $this->info("Open the dashboard using this link: <comment>$appUrl/$prefix</comment>");
    }

    private function askToSetEnv(array $envs, string $default): string
    {
        $value = $this->ask("Set $envs[0] =", $default);
        if (! empty($value)) {
            foreach ($envs as $env) {
                $this->setEnv($env, $value);
            }
        }

        return $value;
    }

    private function choiceToSetEnv(array $envs, array $enum): string
    {
        $value = $this->choice("Set $envs[0] =", $enum, $enum[0]);
        if (! empty($value)) {
            foreach ($envs as $env) {
                $this->setEnv($env, $value);
            }
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
