<?php

declare(strict_types=1);

use TypiCMS\Modules\Things\Models\Thing;

return [
    'model' => Thing::class,
    'linkable_to_page' => true,
    'per_page' => 30,
    'llms_txt' => true,
    'order' => [
        'id' => 'desc',
    ],
    'sidebar' => [
        'icon' => '<i class="icon-grid-2x2"></i>',
        'weight' => 8,
    ],
    'permissions' => [
        'read things' => 'Read',
        'create things' => 'Create',
        'update things' => 'Update',
        'delete things' => 'Delete',
    ],
];
