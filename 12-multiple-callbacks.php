<?php

require_once 'Forker.php';

$forker = new Forker();
$forker->forkCallbacks([
    function() {
        echo "Mighty fine\n";
    },
    function() {
        sleep(1);
        echo "Last\n";
    },
    function() {
        echo "Not last\n";
    },
]);
