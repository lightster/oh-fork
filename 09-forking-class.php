<?php

require_once 'Forker.php';

$forker = new Forker();
$forker->fork(function ($i, $data) {
    echo $i;
    foreach ($data as $j) {
        echo " " . ($i + $j);
    }
    echo "\n";
}, 5, range(1, 5));

$forker->forkRows(function ($key, $row) {
    echo "{$key}: " . implode(" ", $row) . "\n";
}, [
    'a' => [1, 'apple', 'ape'],
    'b' => [2, 'banana', 'bird'],
    'c' => [3, 'cherry', 'cat'],
    'd' => [4, 'date', 'dog'],
    'e' => [5, 'elderberry', 'elephant'],
]);
