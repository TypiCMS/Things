<?php

namespace TypiCMS\Modules\Things\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Things\Models\Thing;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Thing::class)
            ->selectFields()
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->integer('per_page'));

        return $data;
    }

    protected function updatePartial(Thing $thing, Request $request)
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

    public function destroy(Thing $thing)
    {
        $thing->delete();
    }
}
