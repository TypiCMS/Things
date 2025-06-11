<?php

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Things\Models\Thing;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Thing::query()
            ->published()
            ->order()
            ->with('image')
            ->get();

        return view('things::public.index')
            ->with(compact('models'));
    }

    public function show(string $slug): View
    {
        $model = Thing::query()
            ->published()
            ->whereSlugIs($slug)
            ->firstOrFail();

        return view('things::public.show')
            ->with(compact('model'));
    }
}
