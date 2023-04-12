<?php

namespace AdminKit\Core\Ship\Parents\Providers;

use AdminKit\Porto\Abstracts\Providers\AuthServiceProvider as AbstractAuthServiceProvider;

abstract class ParentAuthServiceProvider extends AbstractAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //
    }
}
