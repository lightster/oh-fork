<?php

$pid = pcntl_fork();

if ($pid == -1) {
    echo "The waiter refused to give me a fork!!";
    exit(2);
}

if (!$pid) {
    echo "I am going to sleep now, Papa!\n";
    sleep(5);
    echo "I am awake now.\n";
    exit(0);
}

echo "I will be here when you wake up (" . date('c') .")\n";
$status = null;
pcntl_waitpid($pid, $status);
echo "Good morning, buddy (" . date('c') .")\n";
