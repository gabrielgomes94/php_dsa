<?php

function dfs($graph, &$visited, $start, &$path)
{
    $visited[$start] = true;
    $path[] = $start;

    foreach ($graph[$start] as $adj) {
        if (!$visited[$adj]) {
            dfs($graph, $visited, $adj, $path);
        }
    }
}



$graph = [
    0 => [1, 2],
    1 => [5, 6],
    2 => [3, 4, 8],
    3 => [6, 7],
    4 => [8],
    5 => [7],
    6 => [7],
    7 => [10],
    8 => [9],
    9 => [7],
    10 => [],
];

$visited = [];
$size = count($graph);

for ($i = 0; $i < $size; $i++) {
    $visited[$i] = false;
}


$path = [];
$result = dfs($graph,$visited, 0, $path);

print_r($path);
