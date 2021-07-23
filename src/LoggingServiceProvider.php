<?php

namespace Takshak\Logging;
use Illuminate\Support\ServiceProvider;


class LoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

}