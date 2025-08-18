<?php

namespace TypiCMS\Modules\Things\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use TypiCMS\Modules\Sidebar\SidebarGroup;
use TypiCMS\Modules\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view): void
    {
        if (Gate::denies('read things')) {
            return;
        }
        $view->offsetGet('sidebar')->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Things'), function (SidebarItem $item) {
                $item->id = 'things';
                $item->icon = config('typicms.modules.things.sidebar.icon');
                $item->weight = config('typicms.modules.things.sidebar.weight');
                $item->route('admin::index-things');
            });
        });
    }
}
