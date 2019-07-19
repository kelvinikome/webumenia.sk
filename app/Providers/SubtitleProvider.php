<?php

namespace App\Providers;

use App\Subtitle;
use Illuminate\Support\ServiceProvider;

class SubtitleProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Subtitle::class);
    }
}