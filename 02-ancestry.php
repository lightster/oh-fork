<?php

$pid = pcntl_fork();

if ($pid == -1) {
    echo "This family is in shambles.\n";
    exit(2);
} elseif ($pid) {
    echo "I am the parent";
} else {
    echo "I am the child";
}

echo " and we are related.\n";
