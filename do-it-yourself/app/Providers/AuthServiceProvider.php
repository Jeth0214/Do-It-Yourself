<?php

namespace App\Providers;

use App\Models\Profile;
use App\Policies\IdeasPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     \\'App\Models\Model' => 'App\Policies\ModelPolicy',
    // ];
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Ideas::class => IdeasPolicy::class
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
    }
}
