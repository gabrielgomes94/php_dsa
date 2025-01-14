<?php

function dijkstra($graph, $source, $target) {
    $visited = [];
    $distances = [];
    $predecessors = [];

    foreach ($graph as $node => $adjacencyList) {
        $visited[$node] = 0;
        $distances[$node] = PHP_INT_MAX;
        $predecessors[$node] = null;
    }

    $node = $source;
    $distances[$node] = 0;

    while($node != null) {
        foreach ($graph[$node] as $adjacencyNode => $distance) {
            if (($distances[$node] + $distance) < $distances[$adjacencyNode]) {
                $distances[$adjacencyNode] = $distances[$node] + $distance;
                $predecessors[$node] = $node;
            }
        }
        $visited[$node] = 1;
        $node = get_lowest($distances, $visited);
    }

    return $distances;
}

function get_lowest(mixed $distances, array $visited)
{
    $minimum_distance = PHP_INT_MAX;
    $minimum_distance_node = null;

    foreach ($distances as $node => $distance) {
        if ($distance < $minimum_distance && $visited[$node] == 0) {
            $minimum_distance = $distance;
            $minimum_distance_node = $node;
        }
    }

    return $minimum_distance_node;

}

$graph = [
    'A' => ['B' => 3, 'C' => 5, 'D' => 9],
    'B' => ['A' => 3, 'C' => 3, 'D' => 4, 'E' => 7],
    'C' => ['A' => 5, 'B' => 3, 'D' => 2, 'E' => 6, 'F' => 3],
    'D' => ['A' => 9, 'B' => 4, 'C' => 2, 'E' => 2, 'F' => 2],
    'E' => ['B' => 7, 'C' => 6, 'D' => 2, 'F' => 5],
    'F' => ['C' => 3, 'D' => 2, 'E' => 5],
];

$source = 'A';
$target = 'F';

$result = dijkstra($graph, $source, $target);
extract($result);

print_r($result);