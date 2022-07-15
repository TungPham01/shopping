<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\AdminProductPolicy;
use App\Policies\CategoryPolicy;
use App\Product;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Product::class => AdminProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->gateDefineCategory();

        Gate::define('super-admin', function ($user) {
            return $user->is_admin;
            // ~~ $user->is_admin == 1
            // 1 true
            // 0 false
        });
    }

    public function gateDefineCategory() {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
    }
}
