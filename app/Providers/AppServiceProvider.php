<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->visible(true,outsidePanels: true)
//                ->circular()
                ->flags([
                    'en' => asset('images/lang/en.svg'),
                    'fr' => asset('images/lang/fr.svg'),
                ])

                ->locales(['en', 'fr'])
                ->labels([
                    'en' => __('English'),
                    'fr' => __('Français'),
                ]);
        });
    }

}
