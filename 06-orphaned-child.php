<?php

$pid = pcntl_fork();

if ($pid == -1) {
    echo "The child could not be found.\n";
    exit(2);
}

if (!$pid) {
    echo "I am going to sleep a bit.\n";
    sleep(5);
    exit(0);
}

echo "I am leaving.\n";
