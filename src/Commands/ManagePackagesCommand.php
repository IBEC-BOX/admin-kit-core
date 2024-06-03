<?php

namespace AdminKit\Core\Commands;

use AdminKit\Core\Repositories\PackageRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

use function Laravel\Prompts\multiselect;

class ManagePackagesCommand extends Command
{
    protected $signature = 'admin-kit:package';

    protected $description = 'Manage admin-kit packages';

    private Collection $packages;

    public function __construct(PackageRepository $packageRepository)
    {
        parent::__construct();

        $this->packages = collect($packageRepository->getList());
    }

    public function handle()
    {
        // https://laravel.com/docs/11.x/artisan#progress-bars

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

        if ($toInstallPackages->count() > 0) {
            $this->info('Установка пакетов:');
            $cmd = 'composer require '.$toInstallPackages->implode(' ');
            $this->info($cmd);
            exec($cmd);
        }
    }

    private function getInstalledPackages(): Collection
    {
        $packageLabels = $this->packages->pluck('name')->toArray();

        return collect(json_decode(file_get_contents('composer.json'))->require)
            ->keys()
            ->filter(fn ($packageName) => in_array($packageName, $packageLabels));
    }
}
