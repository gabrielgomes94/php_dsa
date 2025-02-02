<?php


function primMST($graph) {
    $parent = []; // Guarda a MST
    $key = []; // Contem os menores pesos
    $visited = []; // Vertices unseen
    $size = count($graph);

    // Initialize
    for ($i = 0; $i < $size; $i++) {
        $key[$i] =  PHP_INT_MAX;
        $visited[$i] = false;
    }

    $key[0] = 0;
    $parent[0] = -1;

    for ($i = 0; $i < $size ; $i++) {
        // Get minimum key vertex
        $minValue = PHP_INT_MAX;
        $minIndex = -1;

        foreach (array_keys($graph) as $vertex) {
            if (
                $visited[$vertex] == false
                && $key[$vertex] < $minValue
            ) {
                $minValue = $key[$vertex];
                $minIndex = $vertex;
            }
        }

        $u = $minIndex; // WTF is u. u is selected vertex

       // Add the picked vertex to the MST Set
        $visited[$u] = true;

        for ($v = 0; $v < $size; $v++) {
            if (
                $graph[$u][$v] != 0
                && $visited[$v] == false
                && $graph[$u][$v] < $key[$v]
            ) {
                $parent[$v] = $u;
                $key[$v] = $graph[$u][$v];
            }
        }
    }

    echo "Edge \tWeight\n";
    $minimumCost = 0;
    for ($i = 1; $i < $size; $i++) {
        echo $parent[$i] . " - " . $i . "\t" . $graph[$i][$parent[$i]] . "\n";
        $minimumCost += $graph[$i][$parent[$i]];
    }

    echo "Minimum cost: $minimumCost";
}

$graph = [
    [0, 3, 1, 6, 0, 0],
    [3, 0, 5, 0, 3, 0],
    [1, 5, 0, 5, 6, 4],
    [6, 0, 5, 0, 0, 2],
    [0, 3, 6, 0, 0, 6],
    [0, 0, 4, 2, 6, 0],
];

primMST($graph);