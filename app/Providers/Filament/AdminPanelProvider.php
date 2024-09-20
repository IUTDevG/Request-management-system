<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Illuminate\Support\Facades\URL;
use Rmsramos\Activitylog;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->id('admin')
            ->default()
            ->spa()
            ->domain(value(static function () {
                //URL::forceRootUrl($domain);
                return env('ADMIN_DOMAIN');
            }))
            ->path('')
            ->login()
            ->passwordReset()
            ->colors([
                'primary' => Color::hex('#008751'),
                'secondary' => Color::hex('#fcd116'),
                'success' => Color::hex('#004737'),
                'info' => Color::hex('#00271F'),
                'warning' => Color::hex('#00170F'),
                'danger' => Color::hex('#e8001e'),
            ])
            ->font('Poppins')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-user-circle')
                    ->setNavigationGroup('Profile')
                    ->setSort(10)
                    ->shouldShowDeleteAccountForm(false),
                Activitylog\ActivitylogPlugin::make()
                    ->navigationIcon('heroicon-o-shield-check')
                    ->resource(\App\Filament\Admin\Resources\ActivityResource::class),
            ])
            ->brandLogo(fn() => view('filament.adminpanel.logo'))
            ->brandLogoHeight('3.5rem')
            ->brandName('Request management')
            ->favicon(asset('favicon.ico'));
    }
}
