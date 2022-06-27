<?php

namespace AdminKit\Core\Console;

use AdminKit\Core\CoreServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Providers\FoundationServiceProvider;

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
                '--provider' => FoundationServiceProvider::class,
                '--tag' => [
                    'config',
                    'migrations',
                    'orchid-assets',
                ],
            ])
            ->executeCommand('migrate')
            ->executeCommand('storage:link')
            ->changeUserModel()
            ->setValueEnv('SCOUT_DRIVER');

        $this
            ->executeCommand('vendor:publish', [
                '--provider' => CoreServiceProvider::class,
                '--tag' => [
                    'config',
                ],
            ]);

        $this->info('Installed Admin Kit');
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

    private function changeUserModel(string $path = 'Models/User.php'): self
    {
        $this->info('Attempting to set ORCHID User model as parent to App\User');

        if (!file_exists(app_path($path))) {
            $this->warn('Unable to locate "app/Models/User.php".  Did you move this file?');
            $this->warn('You will need to update this manually.');
            $this->warn('Change "extends Authenticatable" to "extends \Orchid\Platform\Models\User" in your User model');
            $this->warn('Also pay attention to the properties so that they are not overwritten.');

            return $this;
        }

        $user = file_get_contents(Dashboard::path('stubs/app/User.stub'));
        file_put_contents(app_path($path), $user);

        return $this;
    }
}
