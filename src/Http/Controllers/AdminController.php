<?php

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Things\Exports\Export;
use TypiCMS\Modules\Things\Http\Requests\FormRequest;
use TypiCMS\Modules\Things\Models\Thing;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('things::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d') . ' ' . config('app.name') . ' things.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Thing();

        return view('things::admin.create')
            ->with(compact('model'));
    }

    public function edit(thing $thing): View
    {
        return view('things::admin.edit')
            ->with(['model' => $thing]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $thing = Thing::create($request->validated());

        return $this->redirect($request, $thing)
            ->withMessage(__('Item successfully created.'));
    }

    public function update(thing $thing, FormRequest $request): RedirectResponse
    {
        $thing->update($request->validated());

        return $this->redirect($request, $thing)
            ->withMessage(__('Item successfully updated.'));
    }
}
