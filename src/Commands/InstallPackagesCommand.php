<?php

namespace AdminKit\Core\Commands;

use AdminKit\Core\Repositories\PackageRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\multiselect;

class InstallPackagesCommand extends Command
{
    protected $signature = 'admin-kit:install-packages {--local}';

    protected $description = 'Install AdminKit other packages';

    private Collection $packages;

    public function __construct(PackageRepository $packageRepository)
    {
        parent::__construct();

        $this->packages = collect($packageRepository->getList());
    }

    public function handle()
    {
        // https://laravel.com/docs/11.x/artisan#progress-bars

        if ($this->option('local') && ! shell_command_exists('composer-local')) {
            $this->error('composer-local не установлен');
            $this->comment('Установите composer-local: https://github.com/ibec-box/composer-dev');
            return;
        }

        // Check installed packages
        $installedPackages = $this->getInstalledPackages();

        if ($installedPackages->count() > 0) {
            $this->info('Список установленных пакетов:');
            $installedPackages->each(fn ($packageName) => $this->line("- $packageName"));
            $this->newLine();
        }

        $packages = $this->packages
            ->filter(fn ($package) => ! in_array($package['name'], $installedPackages->toArray()));

        // install packages
        $toInstallPackages = collect(multiselect(
            label: 'Выберите пакеты для установки:',
            options: $packages
                ->mapWithKeys(fn ($package) => [$package['name'] => $package['label'] ?? $package['name']])
                ->toArray(),
        ));

        if ($toInstallPackages->count() === 0) {
            return;
        }

        $info = 'Установка пакетов:';
        $cmd = 'composer require '.$toInstallPackages->implode(' ');

        if ($this->option('local')) {
            $info = 'Установка пакетов с помощью composer-local:';
            $cmd = 'composer-local require '.$toInstallPackages->implode(' ');
        }

        $this->info($info);
        $this->info($cmd);
        exec($cmd);
    }

    private function getInstalledPackages(): Collection
    {
        $packageLabels = $this->packages->pluck('name')->toArray();

        // get installed packages to string
        $installedPackages = shell_exec('composer show --name-only');

        if (! $installedPackages) {
            return collect();
        }

        // string rows to array
        $installedPackages = preg_split("/\r\n|\n|\r/", $installedPackages);

        return collect($installedPackages)
            ->filter(fn ($packageName) => in_array($packageName, $packageLabels));
    }
}
