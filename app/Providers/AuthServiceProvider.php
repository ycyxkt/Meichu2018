<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('edit-team', function ($user, $team) {
            return $user->school == $team->school || $user->school == 'other';
        });
        Gate::define('edit-news', function ($user, $news) {
            if ($news==NULL){
                return false;
            }
            if ($user->group=='committee'){
                $tmp = \App\User::find($news->user_id);
                return $tmp->group == 'committee';
            }
            elseif ($user->group=='admin'){
                return true;
            }
            else {
                return $user->id == $news->user_id;
            }
        });
    }

}
