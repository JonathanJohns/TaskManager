<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Users;
use App\Clients;
use App\Tasks;
use App\Projects;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::before(function($users, $roles){
            $user = Auth::user()->roles;
            if($users == 'super-admin') {
                return true;
            }
        });

        Gate::define('super-admin', function($users, $roles) {
            $users = 'super-admin';
            


            return $users == $roles;


        });
    }
}
