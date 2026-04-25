<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Things\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Override;
use TypiCMS\Modules\Things\Composers\SidebarViewComposer;

class ModuleServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/things.php', 'typicms.modules.things');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/things.php');

        $this->publishes([
            __DIR__.'/../resources/views/admin/things' => resource_path('views/admin/things'),
        ], ['typicms-views', 'typicms-admin-views', 'typicms-admin-things-views']);
        $this->publishes([
            __DIR__.'/../resources/views/public/things' => resource_path('views/public/things'),
        ], ['typicms-views', 'typicms-public-views', 'typicms-public-things-views']);

        View::composer('admin::core._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('public::things.*', function ($view): void {
            $view->page = getPageLinkedToModule('things');
        });
    }
}
