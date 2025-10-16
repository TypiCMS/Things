<?php

namespace TypiCMS\Modules\Things\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Core\Models\File;
use TypiCMS\Modules\Core\Traits\HasFiles;
use TypiCMS\Modules\Core\Traits\Historable;
use TypiCMS\Modules\Things\Presenters\ModulePresenter;

/**
 * @property int $id
 * @property int|null $image_id
 * @property string $status
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Thing extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected string $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $appends = ['thumb'];

    /** @var array<string> */
    public array $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    /** @var array<string> */
    public array $tipTapContent = [
        'body',
    ];

    public function url(?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        $route = $locale . '::thing';
        $slug = $this->translate('slug', $locale) ?: null;

        return Route::has($route) && $slug ? url(route($route, $slug)) : url('/');
    }

    /** @return Attribute<string, null> */
    protected function thumb(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->present()->image(null, 54),
        );
    }

    /** @return BelongsTo<File, $this> */
    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    /** @return BelongsTo<File, $this> */
    public function ogImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'og_image_id');
    }
}
