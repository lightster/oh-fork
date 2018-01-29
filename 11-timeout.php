<?php

require_once 'Forker.php';

$agents = [
    'Morgan'   => 4,
    'Reid'     => 0,
    'Hotchner' => 7,
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
        exit($time);
    }

    $pids[$pid] = $agent;
}

declare(ticks=1);

pcntl_signal(SIGALRM, function($signo) use (&$pids) {
    foreach($pids as $pid => $agent) {
        posix_kill($pid, SIGTERM);
    }
});

pcntl_alarm(4);

while ($pids) {
    $status = null;
    $pid = pcntl_wait($status);
    if ($pid == -1) {
        echo "Hmm. We did not witness everyone finish.\n";
        continue;
    }

    if (pcntl_wifexited($status)) {
        echo "I witnessed {$pids[$pid]} finish.\n";
    } else {
        echo "{$pids[$pid]} took too long.\n";
    }

    unset($pids[$pid]);
}
