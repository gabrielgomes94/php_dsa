<?php


function dfs(array $graph, array &$visited, int $start)
{
    $visited[$start] = true;

    foreach ($graph[$start] as $node => $isConnected) {
        if (!($visited[$node] ?? 0)) dfs($graph, $visited, $node);
    }
}


$graph = [
    [
        1 => 1,
        2 => 1
    ],
    [
        2 => 1
    ],
    [],
    [
        4 => 1
    ],
    [
        3 => 1
    ]
];

$visited = [];
dfs($graph, $visited, 2);

print_r($visited);