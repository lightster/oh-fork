<?php

require_once 'Forker.php';

$forker = new Forker();
$forker->forkCallbacks([
    function() {
        echo "Mighty fine\n";
    },
    function() use ($forker) {
        $forker->forkCallbacks([
            function() {
                echo "1. three?\n";
            },
            function() {
                echo "2. one?\n";
            },
            function() {
                echo "3. two!?\n";
            },
        ]);
        sleep(2);
        echo "Last\n";
    },
    function() {
        sleep(1);
        echo "Not last\n";
    },
]);
