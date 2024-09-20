<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dashboard')
            ->default()
            ->path('dashboard')
            ->login()
            ->spa()
            ->domain(value(static function () {
                //URL::forceRootUrl($domain);
                return env('DASHBOARD_DOMAIN');
            }))
            ->passwordReset()
            ->colors([
                'primary' => Color::hex('#008751'),
                'secondary' => Color::hex('#fcd116'),
                'success' => Color::hex('#004737'),
                'info' => Color::hex('#00271F'),
                'warning' => Color::hex('#00170F'),
                'danger' => Color::hex('#e8001e'),
            ])
            ->font('Figtree')
            ->discoverResources(in: app_path('Filament/Dashboard/Resources'), for: 'App\\Filament\\Dashboard\\Resources')
            ->discoverPages(in: app_path('Filament/Dashboard/Pages'), for: 'App\\Filament\\Dashboard\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverWidgets(in: app_path('Filament/Dashboard/Widgets'), for: 'App\\Filament\\Dashboard\\Widgets')
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-user-circle')
                    ->setNavigationGroup('Profile')
                    ->setSort(10)
                    ->shouldShowDeleteAccountForm(false)
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->brandLogoHeight('3.5rem')
            ->brandLogo(fn() => view('filament.dashbordpanel.logo'))
            ->favicon(asset('favicon.ico'));
    }
}
