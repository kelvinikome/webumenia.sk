<?php

namespace App\Providers;

use App\Repositories\AuthorityRepository;
use Illuminate\Support\ServiceProvider;

class AuthorityRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorityRepository::class);
    }
}