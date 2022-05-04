<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        $charts->register([
            \App\Charts\ProgressChart::class,
            \App\Charts\CurrentSeasonChart::class,
            \App\Charts\CompareFromLastChart::class,
            \App\Charts\CurrentYield::class,
            \App\Charts\CompareFromLastYield::class,
            \App\Charts\LastFiveYield::class
        ]);

        
    }
}
