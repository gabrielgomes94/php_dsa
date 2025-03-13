<?php


function dijkstra(array $graph, string $source, string $target) {
    $distance = [];
    $predecessors = [];
    $queue = new SplPriorityQueue();

    foreach ($graph as $v => $adj) {
        $distance[$v] = PHP_INT_MAX;
        $predecessors[$v] = null;
        $queue->insert($v, min($adj)); // min($adj) finds the lowest number
    }

    $distance[$source] = 0;

    while (!$queue->isEmpty()) {
        $node = $queue->extract();

        if (!empty($graph[$node])) {
            foreach ($graph[$node] as $adjacency => $cost) {
                if ($distance[$node] + $cost < $distance[$adjacency]) {
                    $distance[$adjacency] = $distance[$node] + $cost;
                    $predecessors[$adjacency] = $node;
                }
            }
        }
    }

    $stack = new SplStack();
    $node = $target;
    $distance = 0;

    while (isset($predecessors[$node]) && $predecessors[$node]) {
        $stack->push($node);
        $distance += $graph[$node][$predecessors[$node]];
        $node = $predecessors[$node];
    }

    if ($stack->isEmpty()) {
        return [
            'distance' => 0,
            'path' => $stack,
        ];
    }

    return [
        'distance' => $distance,
        'path' => $stack,
    ];
}

$graph = [
    'A' => ['B' => 3, 'C' => 5, 'D' => 9],
    'B' => ['A' => 3, 'C' => 3, 'D' => 4, 'E' => 7],
    'C' => ['A' => 5, 'B' => 3, 'D' => 2, 'E' => 6, 'F' => 3],
    'D' => ['A' => 9, 'B' => 4, 'C' => 2, 'E' => 2, 'F' => 2],
    'E' => ['B' => 7, 'C' => 6, 'D' => 2, 'F' => 5],
    'F' => ['C' => 3, 'D' => 2, 'E' => 5],
];

$source = 'B';
$target = 'F';

$result = dijkstra($graph, $source, $target);
extract($result);



echo "Distance from $source to $target is $distance \n";
echo "Path to follow : $source\t";
while (!$path->isEmpty()) {
    echo $path->pop() . "\t";
}