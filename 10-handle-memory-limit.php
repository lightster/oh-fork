<?php

require_once 'Forker.php';

ini_set('memory_limit', '16M');

$forker = new Forker();

$rows = range(0, 20);

$exit_statuses = $forker->forkRows(
    function ($key, $fill_amount) {
        error_reporting(0);
        register_shutdown_function(function () use ($fill_amount) {
            if (error_get_last()) {
                echo "{$fill_amount}: errored\n";
            }
        });

        $data = str_repeat('A', $fill_amount * 1024 * 1024);
        echo $fill_amount . ': ' . strlen($data) . "\n";
    },
    $rows
);

exit(0);
