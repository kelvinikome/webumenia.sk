<?php

namespace App\Providers;

use App\Repositories\ItemRepository;
use Illuminate\Support\ServiceProvider;

class ItemRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ItemRepository::class);
    }
}