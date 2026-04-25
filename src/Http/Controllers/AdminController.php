<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Things\Exports\Export;
use TypiCMS\Modules\Things\Http\Requests\FormRequest;
use TypiCMS\Modules\Things\Models\Thing;

final class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('admin::things.index');
    }

    public function export(Request $request): BinaryFileResponse
    {
        $filename = date('Y-m-d').' '.config('app.name').' things.xlsx';

        return Excel::download(new Export, $filename);
    }

    public function create(): View
    {
        $model = new Thing;

        return view('admin::things.create', ['model' => $model]);
    }

    public function edit(Thing $thing): View
    {
        return view('admin::things.edit', ['model' => $thing]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $thing = Thing::query()->create($request->validated());

        return $this->redirect($request, $thing)->withMessage(__('Item successfully created.'));
    }

    public function update(Thing $thing, FormRequest $request): RedirectResponse
    {
        $thing->update($request->validated());

        return $this->redirect($request, $thing)->withMessage(__('Item successfully updated.'));
    }
}
