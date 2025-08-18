<?php

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Things\Models\Thing;

class ApiController extends BaseApiController
{
    /** @return LengthAwarePaginator<int, mixed> */
    public function index(Request $request): LengthAwarePaginator
    {
        $query = Thing::query()->selectFields();
        $data = QueryBuilder::for($query)
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->integer('per_page'));

        return $data;
    }

    protected function updatePartial(Thing $thing, Request $request): void
    {
        foreach ($request->only('status') as $key => $content) {
            if ($thing->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $thing->setTranslation($key, $lang, $value);
                }
            } else {
                $thing->{$key} = $content;
            }
        }

        $thing->save();
    }

    public function duplicate(Thing $thing): void
    {
        $newThing = $thing->replicate();
        $newThing->setTranslations('status', []);
        $newThing->save();
    }

    public function destroy(Thing $thing): JsonResponse
    {
        $thing->delete();

        return response()->json(status: 204);
    }
}
