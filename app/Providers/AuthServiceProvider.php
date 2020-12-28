<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{    
    /**
     * An array mapping permissions to roles
     *
     * @var array
     */
    public static $permissions = [
        'index_product' => ['manager', 'customer'],
        'show_product' => ['manager', 'customer'],
        'create_product' => ['manager'],
        'store_product' => ['manager'],
        'edit_product' => ['manager'],
        'update_product' => ['manager'],
        'destroy_product' => ['manager'],
    ];
    
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Roles based authorization
        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        foreach(self::$permissions as $permission => $roles) {
            Gate::define($permission, function (User $user) use ($roles) {
                foreach ($roles as $role) {
                    if($user->role === $role) {
                        return true;
                    }
                }
            });
        }
    }
}
