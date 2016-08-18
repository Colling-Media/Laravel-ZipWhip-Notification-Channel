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
                if(isset($config['api_key'])) {
                    return new ZipWhipClient($config['api_key'], null, null);
                } else {
                    return new ZipWhipClient(null, $config['user'], $config['pass']);
                }
            });
    }
}
