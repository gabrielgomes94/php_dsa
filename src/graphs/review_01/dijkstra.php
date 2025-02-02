<?php


function dijkstra($graph, $start) {
//    $queue = [];
//    $queue[] = $start;
    $distance = [];
    $predecessor = [];
    $size = count($graph);

    for ($i = 0; $i < $size; $i++) {
        $distance[$i] = PHP_INT_MAX;
        $predecessor[$i] = null;
        $visited[$i] = false;
    }

    $distance[$start] = 0;
    $node = $start;

    while($node !== null) {
        foreach ($graph[$node] as $adj => $dist) {
            if ($visited[$adj]) continue;

            if ($distance[$adj] > $dist + $distance[$node]) {
                $distance[$adj] = $dist + $distance[$node];
                $predecessor[$adj] = $node;
            }
        }

        $visited[$node] = true;
        $node = lowest_cost($distance, $visited);
    }


    return [$distance, $predecessor];

}

function lowest_cost(array $distance_list, $visited)
{
    $minimum_cost = null;
    $minimum_cost_distance = PHP_INT_MAX;

    foreach ($distance_list as $node => $distance) {
        if ($visited[$node]) continue;
        if ($distance < $minimum_cost_distance) {
            $minimum_cost = $node;
            $minimum_cost_distance = $distance;
        }
    }

    return $minimum_cost;
}


$graph = [
    0 => [
        1 => 3,
//        2 => 1,
        3 => 14,
    ],
    1 => [
        2 => 1,
        3 => 1,
    ],
    2 => [
        3 => 5,
    ],
    3 => [
    ],
];

$visited = [];

$result = dijkstra($graph, 0);

print_r($result);
