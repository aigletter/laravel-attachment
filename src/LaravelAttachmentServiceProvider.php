<?php


namespace Aigletter\LaravelAttachment;


use Illuminate\Support\ServiceProvider;

class LaravelAttachmentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/attachment.php', 'attachment'
        );
        
        $this->app->singleton(LaravelAttachment::class, function($app){
            return new LaravelAttachment($app);
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/attachment.php' => config_path('attachment.php'),
        ]);
    }
}