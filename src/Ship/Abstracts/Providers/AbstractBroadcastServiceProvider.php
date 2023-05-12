<?php

namespace AdminKit\Core\Ship\Abstracts\Providers;

use AdminKit\Porto\Abstracts\BroadcastServiceProvider;
use Illuminate\Support\Facades\Broadcast;

abstract class AbstractBroadcastServiceProvider extends BroadcastServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require app_path('Ship/Broadcasts/channels.php');
    }
}
