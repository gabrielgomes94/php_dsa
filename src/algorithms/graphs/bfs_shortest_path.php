<?php


function bfs(array $graph, array $distance, array $parent, int $start) {
    for ($i = 0; $i < count($graph); $i++) {
        $distance[$i] = -1;
        $parent[$i] = null;
    }

    $queue = new SplQueue();
    $queue->enqueue($start);
    $distance[$start] = 0;

    while (!$queue->isEmpty()) {
        $node = $queue->dequeue();
//        $distance[$node]++;

        foreach($graph[$node] as $adjacency) {
            if ($distance[$adjacency] != -1) continue;

            $distance[$adjacency] = $distance[$node] + 1;
            $parent[$adjacency] = $node;
            $queue->enqueue($adjacency);
        }
    }

    print_r($distance);
    print_r($parent);
}

$graph = [
    0 => [1, 2],
    1 => [2, 4],
    2 => [],
    3 => [4, 5],
    4 => [3, 5],
    5 => [],
];

echo bfs($graph, [], [], 0);