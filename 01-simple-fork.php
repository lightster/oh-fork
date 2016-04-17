<?php

$pid = pcntl_fork();

if ($pid == -1) {
    echo "R2, what's going on here?\n";
    exit(2);
} elseif ($pid) {
    echo "Luke, I am your father! ({$pid})\n";
} else {
    echo "Noooooo!\n";
}
