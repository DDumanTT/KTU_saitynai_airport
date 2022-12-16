<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Airport;
use App\Policies\AirlinePolicy;
use App\Policies\AirportPolicy;
use App\Policies\CityPolicy;
use App\Policies\FlightPolicy;
use App\Policies\PlanePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        City::class => CityPolicy::class,
        Airport::class => AirportPolicy::class,
        Flight::class => FlightPolicy::class,
        Airline::class => AirlinePolicy::class,
        Plane::class => PlanePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::tokensExpireIn(now()->addMinutes(5));
        Passport::refreshTokensExpireIn(now()->addDays(10));
    }
}
