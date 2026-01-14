<?php

declare(strict_types=1);

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

        $view->offsetGet('sidebar')->group(
            __(config('typicms.modules.things.sidebar.group', 'Content')),
            function (SidebarGroup $group): void {
                $group->id = 'content';
                $group->weight = 30;
                $group->addItem(
                    __(config('typicms.modules.things.sidebar.label', 'Things')),
                    function (SidebarItem $item): void {
                        $item->id = 'things';
                        $item->icon = config('typicms.modules.things.sidebar.icon');
                        $item->weight = config('typicms.modules.things.sidebar.weight');
                        $item->route('admin::index-things');
                    },
                );
            },
        );
    }
}
