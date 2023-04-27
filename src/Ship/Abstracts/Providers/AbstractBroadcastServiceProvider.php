<?php

namespace AdminKit\Core\Ship\Parents\Providers;

use AdminKit\Porto\Abstracts\Providers\BroadcastServiceProvider as AbstractBroadcastServiceProvider;
use Illuminate\Support\Facades\Broadcast;

abstract class AbstractBroadcastServiceProvider extends AbstractBroadcastServiceProvider
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
