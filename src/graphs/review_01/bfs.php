<?php


/**
 * BFS implementation using only PHP's native array
 * @param $graph
 * @param $visited
 * @param $start
 * @return array
 */
function bfs ($graph, &$visited, $start) {
    $size = count($graph);

    for ($i = 0; $i < $size; $i++) {
        $visited[$i] = false;
    }

    $nodeQueue = [];
    $nodeQueue[] = $start;
    $path = [];
    $path[] = $start;

    while (!empty($nodeQueue)) {
        $node = array_shift($nodeQueue);

        foreach ($graph[$node] as $adjacent) {
            if (!$visited[$adjacent]) {
                $nodeQueue[] = $adjacent;
                $path[] = $adjacent;
                $visited[$adjacent] = true;
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
    7 => [10],
    8 => [9],
    9 => [7],
    10 => [],
];

$visited = [];

$result = bfs($graph,$visited, 0);

print_r($result);


