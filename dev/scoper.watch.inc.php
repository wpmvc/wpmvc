<?php

declare(strict_types=1);

$config = require __DIR__ . '/../dev-tools/scoper/global.config.php';

return array_merge(
    [
        'finders' => [],
    ], $config
);