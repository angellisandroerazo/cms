<?php

namespace App\Providers;

use App\Models\ExtraPage;
use App\Models\System;
use App\Models\User;
use App\Policies\ActivityPolicy;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Commands;

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
        Schema::defaultStringLength(190);

        Commands\SetupCommand::prohibit($this->app->isProduction());
        Commands\InstallCommand::prohibit($this->app->isProduction());
        Commands\GenerateCommand::prohibit($this->app->isProduction());
        Commands\PublishCommand::prohibit($this->app->isProduction());
        // or prohibit the above commands all at once
        FilamentShield::prohibitDestructiveCommands($this->app->isProduction());

        Gate::policy(Activity::class, ActivityPolicy::class);

        View::composer('templates.header', function ($view) {

            $info_site = System::select('name_site', 'url_site', 'favicon', 'logo', 'about', 'contact', 'about_title', 'contact_title')
                ->first();

            $categories = Category::select('name', 'slug')
                ->get();

            if (!$info_site) {
                $info_site = new System();
                $info_site->name_site = config('app.name');
                $info_site->favicon = 'images/favicon.ico';
                $info_site->url_site = config('app.url');
                $info_site->about = false;
                $info_site->contact = false;

                $view->with('system', $info_site)
                    ->with('categories', $categories);
            }

            $view->with('categories', $categories)
                ->with('system', $info_site);
        });

        View::composer('templates.footer', function ($view) {

            $info_site = System::select('about', 'contact', 'about_title', 'contact_title')
                ->first();

            $extra_pages = ExtraPage::where('show', true)
                ->select('title', 'slug')->get();

            if (!$info_site) {
                $info_site = new System();
                $info_site->about = false;
                $info_site->contact = false;

                $view->with('system', $info_site)
                    ->with('extra_pages', $extra_pages);
            }

            $view->with('system', $info_site)
                ->with('extra_pages', $extra_pages);
        });

        View::composer('layouts.layout', function ($view) {
            $info_site = System::select('name_site', 'favicon', 'url_site')
                ->first();

            if (!$info_site) {
                $info_site = new System();
                $info_site->name_site = config('app.name');
                $info_site->favicon = 'images/favicon.ico';
                $info_site->url_site = config('app.url');

                $view->with('system', $info_site);
            }

            $view->with('system', $info_site);
        });
    }
}
