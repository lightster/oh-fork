<?php

$children = [
    'Peter',
    'Matt',
    'Susan',
    'Edmund',
    'Lucy',
];

$pid = $child = null;
$roster = [];
foreach ($children as $child) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        echo "Something happened to {$pid}.\n";
        exit(2);
    }

    // don't keep looping in the child
    if (!$pid) {
        break;
    }

    $roster[$child] = $pid;
}

if (!$pid) {
    exit(('Matt' === $child ? 24 : 0));
}

if (!$roster) {
    echo "No children are on the roster.\n";
    exit(3);
}

foreach ($roster as $child => $pid) {
    $fork_status = null;
    pcntl_waitpid($pid, $fork_status);

    if (pcntl_wexitstatus($fork_status)) {
        echo "{$child} is absent.\n";
    } else {
        echo "{$child} is present.\n";
    }
}
