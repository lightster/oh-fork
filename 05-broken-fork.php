<?php

$pid = pcntl_fork();

if ($pid == -1) {
    echo "This fork broke in an unexpected way.\n";
    exit(2);
}

if (!$pid) {
    echo "I am about to break!\n";
    exit(24);
}

$status = null;
pcntl_waitpid($pid, $status);

if (pcntl_wifexited($status)) {
    $exit_code = pcntl_wexitstatus($status);
    echo "The fork broke! ({$exit_code})\n";
} else {
    echo "The fork was supposed to break but did not.";
}
