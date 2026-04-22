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

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'things');

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('things::public.*', function ($view): void {
            $view->page = getPageLinkedToModule('things');
        });
    }
}
