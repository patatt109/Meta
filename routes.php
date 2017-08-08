<?php

return [
    [
        'route' => '/robots.txt',
        'target' => [\Modules\Meta\Controllers\MetaController::class, 'robots'],
        'name' => 'robots'
    ],
];