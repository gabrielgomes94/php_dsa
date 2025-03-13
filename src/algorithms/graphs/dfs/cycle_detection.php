<?php

$graph = [
    0 => [1, 2],
    1 => [2],
    2 => [0, 3],
    3 => [3]
];


function dfs($graph, $node, $visited, $inStack)
{
    $visited[$node] = 1;
    $inStack[$node] = 1;

    foreach ($graph[$node] as $adjacent) {
        if (!$visited[$adjacent]) {
            if (dfs($graph, $adjacent, $visited, $inStack)) return true;
        }
        elseif ($inStack[$adjacent]) return true;
    }

    $inStack[$node] = false;
    return false;
}

function detect_cycle(array $graph)
{
    $size = count($graph);
    $visited = array_fill(0, $size, 0);
    $inStack = array_fill(0, $size, 0);

    foreach ($graph as $node => $adjacents) {
        if (!$visited[$node]) {
            if (dfs($graph, $node, $visited, $inStack)) return true;
        }
    }

    return false;
}

if (detect_cycle($graph))
    print("O grafo contém um ciclo.");
else
    print("O grafo não contém um ciclo.");