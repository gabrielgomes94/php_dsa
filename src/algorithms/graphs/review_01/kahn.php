<?php



function topologicalSort($graph, $visited, $start) {
    $path = [];
    $indegrees = [];
    $size = count($graph);
    $queue = [];

    for ($i = 0; $i < $size; $i++) {
        $indegrees[$i] = 0;
    }

    foreach ($graph as $node => $adjList) {
        foreach ($adjList as $adj) {
            $indegrees[$adj]++;
        }
    }

    for ($i = 0; $i < $size; $i++) {
        if ($indegrees[$i] == 0) $queue[] = $i;
    }

    while(!empty($queue)) {
        $node = array_shift($queue);
        $path[] = $node;

        foreach ($graph[$node] as $adj) {
            $indegrees[$adj]--;

            if ($indegrees[$adj] == 0) {
                $queue[] = $adj;
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

$result = topologicalSort($graph,$visited, 0);

print_r($result);
