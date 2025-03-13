<?php

function dfs($graph, $visited, $start)
{
    $size = count($graph);

    for ($i = 0; $i < $size; $i++) {
        $visited[$i] = false;
    }

    $path = [];
    $nodeStack = [];
    $nodeStack[] = $start;
    $path[] = $start;

    while(!empty($nodeStack)) {
        $node = array_pop($nodeStack);

        foreach ($graph[$node] as $adjacent) {
            if (!$visited[$adjacent]) {
                $visited[$adjacent] = true;
                $nodeStack[] = $adjacent;
                $path[] = $adjacent;
            }
        }
    }

    return $path;
}


$graph = [
    0 => [1, 2],
    1 => [5, 6],
    2 => [3, 4, 8],
    3 => [6, 7],
    4 => [8],
    5 => [7],
    6 => [7],
    7 => [9, 10],
    8 => [1],
    9 => [7],
    10 => [],
];

$visited = [];

$result = dfs($graph,$visited, 0);

print_r($result);


