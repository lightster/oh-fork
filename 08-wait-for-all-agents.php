<?php

$agents = [
    'Morgan'   => 4,
    'Reid'     => 0,
    'Hotchner' => 2,
    'Prentiss' => 1,
    'Rossi'    => 3,
    'JJ'       => 4,
    'Penelope' => 4,
];

$pids = [];
foreach ($agents as $agent => $time) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        exit(2);
    }

    if (!$pid) {
        sleep($time);
        echo "{$agent} took {$time} seconds.\n";
        exit(0);
    }

    $pids[$pid] = $agent;
}

while ($pids) {
    $pid = pcntl_wait($status);
    if ($pid == -1) {
        echo "Hmm. We did not witness everyone finish.";
        exit(1);
    }

    echo "I witnessed {$pids[$pid]} finish.\n";
    unset($pids[$pid]);
}
