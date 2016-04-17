<?php

$dinner = [
    'chicken',
    'green beans',
    'apple',
];

$pid = pcntl_fork();

if ($pid == -1) {
    echo "I am not in the sharing mood.\n";
    exit(2);
}

if (!$pid) {
    foreach ($dinner as $food) {
        echo "Eating {$food} with fork\n";
    }
    exit(0);
}

$status = null;
pcntl_waitpid($pid, $status);

foreach ($dinner as $food) {
    echo "You ate all of the {$food}\n";
}
