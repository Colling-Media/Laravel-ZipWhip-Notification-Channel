<?php

namespace NotificationChannels\ZipWhip;

use Illuminate\Support\ServiceProvider;

class ZipWhipServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->when(ZipWhipChannel::class)
            ->needs(ZipWhipClient::class)
            ->give(function () {
                $config = config('services.zipwhip');

                return new ZipWhipClient($config['user'], $config['pass']);
            });
    }
}
