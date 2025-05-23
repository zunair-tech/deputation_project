<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\YouTubeDownloader;

class YouTubeDownloaderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(YouTubeDownloader::class, function ($app) {
            return new YouTubeDownloader();
        });
    }
}
