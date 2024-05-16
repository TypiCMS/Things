<?php

namespace TypiCMS\Modules\Things\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Things\Composers\SidebarViewComposer;
use TypiCMS\Modules\Things\Facades\Things;
use TypiCMS\Modules\Things\Models\Thing;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/things.php', 'typicms.modules.things');

        $this->loadRoutesFrom(__DIR__ . '/../routes/things.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'things');

        AliasLoader::getInstance()->alias('Things', Things::class);

        // Observers
        Thing::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('things::public.*', function ($view) {
            $view->page = getPageLinkedToModule('things');
        });
    }

    public function register(): void
    {
        $this->app->bind('Things', Thing::class);
    }
}
