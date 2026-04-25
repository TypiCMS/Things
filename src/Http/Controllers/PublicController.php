<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Things\Models\Thing;

final class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Thing::query()
            ->published()
            ->order()
            ->with('image')
            ->get();

        return view('public::things.index', ['models' => $models]);
    }

    public function show(string $slug): View
    {
        $model = Thing::query()
            ->published()
            ->whereSlugIs($slug)
            ->firstOrFail();

        return view('public::things.show', ['model' => $model]);
    }
}
