<?php

return [
    'linkable_to_page' => true,
    'per_page' => 30,
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
