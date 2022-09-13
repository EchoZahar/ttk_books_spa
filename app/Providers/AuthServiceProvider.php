<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', fn (User $user) => $user->type === 'admin'
            ? Response::allow()
            : Response::deny('Only administrators access')
        );

        $gate->define('isAuthor', fn (User $user) => $user->type === 'author');
        $gate->define('isAuthor', fn (User $user) => $user->type === 'user');
    }
}
