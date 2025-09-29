<?php

use TypiCMS\Modules\Core\Models\Page;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Things\Http\Controllers\AdminController;
use TypiCMS\Modules\Things\Http\Controllers\ApiController;
use TypiCMS\Modules\Things\Http\Controllers\PublicController;

/*
 * Front office routes
 */
if (($page = getPageLinkedToModule('things')) instanceof Page) {
    $middleware = $page->private ? ['public', 'auth'] : ['public'];
    foreach (locales() as $lang) {
        if ($page->isPublished($lang) && $path = $page->path($lang)) {
            Route::middleware($middleware)->prefix($path)->name($lang . '::')->group(function (Router $router): void {
                $router->get('/', [PublicController::class, 'index'])->name('index-things');
                $router->get('{slug}', [PublicController::class, 'show'])->name('thing');
            });
        }
    }
}

/*
 * Admin routes
 */
Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router): void {
    $router->get('things', [AdminController::class, 'index'])->name('index-things')->middleware('can:read things');
    $router->get('things/export', [AdminController::class, 'export'])->name('export-things')->middleware('can:read things');
    $router->get('things/create', [AdminController::class, 'create'])->name('create-thing')->middleware('can:create things');
    $router->get('things/{thing}/edit', [AdminController::class, 'edit'])->name('edit-thing')->middleware('can:read things');
    $router->post('things', [AdminController::class, 'store'])->name('store-thing')->middleware('can:create things');
    $router->put('things/{thing}', [AdminController::class, 'update'])->name('update-thing')->middleware('can:update things');
});

/*
 * API routes
 */
Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router): void {
    $router->get('things', [ApiController::class, 'index'])->middleware('can:read things');
    $router->patch('things/{thing}', [ApiController::class, 'updatePartial'])->middleware('can:update things');
    $router->post('things/{thing}/duplicate', [ApiController::class, 'duplicate'])->middleware('can:create things');
    $router->delete('things/{thing}', [ApiController::class, 'destroy'])->middleware('can:delete things');
});
