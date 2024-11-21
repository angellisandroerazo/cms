<?php

namespace App\Providers\Filament;

use App\Models\System;
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
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Log;
use Illuminate\Validation\Rules\Password;
use Pest\ArchPresets\Custom;
use Schema;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        $favicon = asset('/images/favicon.ico');
        $brandName = config('app.name');
        $enable_comments = false;

        if (Schema::hasTable('system')) {
            $info_site = System::first();

            if ($info_site) {
                $favicon = $info_site->url . ' /storage/' . $info_site->favicon;
                $brandName = $info_site->name_site;
                $enable_comments = $info_site->enable_comments;
            }
        } else {
            Log::warning('La tabla "system" no existe. Ejecute las migraciones.');
        }

        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
            ->profile()
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName($brandName)
            ->favicon($favicon)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                RenewPasswordPlugin::make()
                    ->passwordExpiresIn(days: 30)
                    ->forceRenewPassword(),
                ActivitylogPlugin::make()
                    ->navigationGroup('Admin Panel'),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        hasAvatars: true,
                        slug: 'my-profile'
                    )
                    ->enableTwoFactorAuthentication(
                        force: false, // force the user to enable 2FA before they can use the application (default = false)
                    )
                    ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                    ->passwordUpdateRules(
                        rules: [Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
                        requiresCurrentPassword: false
                    ),
            ]);
        ;
    }
}
