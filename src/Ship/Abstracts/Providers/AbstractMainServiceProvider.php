<?php

namespace AdminKit\Core\Ship\Abstracts\Providers;

use AdminKit\Porto\Abstracts\PortoMainServiceProvider;
use Illuminate\Support\Facades\File;
use SplFileInfo;

abstract class AbstractMainServiceProvider extends PortoMainServiceProvider
{
    public function boot(): void
    {
        $this->publishMigrations();

        parent::boot();
    }

    protected function publishMigrations(): void
    {
        $migrationPath = $this->containerPath.'/Database/Migrations';

        if (File::isDirectory($migrationPath)) {
            $files = collect(File::files($migrationPath))
                ->filter(fn (SplFileInfo $file) => $file->getExtension() === 'stub')
                ->mapWithKeys(function (SplFileInfo $file) {
                    $fileName = str_replace('.stub', '.php', $file->getFilename());

                    return [$file->getPathName() => database_path("migrations/$fileName")];
                })
                ->toArray();

            $this->publishes($files, 'admin-kit-migrations');
        }
    }
}
