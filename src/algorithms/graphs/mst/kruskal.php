<?php

function kruskal(array $graph) {
    $size = count($graph);
    $tree = [];
    $set = [];

    foreach ($graph as $k => $adj) {
        $set[$k] = [$k];
    }

    $edges = [];
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($graph[$i][$j]) {
                $edges[$i . ',' . $j] = $graph[$i][$j];
            }
        }
    }

    asort($edges);

    foreach ($edges as $k => $w) {
        list($i, $j) = explode(',', $k);

        $iSet = findSet($set, $i);
        $jSet = findSet($set, $j);

        if ($iSet != $jSet) {
            $tree[] = [
                'from' => $i,
                'to' => $j,
                'cost' => $graph[$i][$j],
            ];
            unionSet($set, $iSet, $jSet);
        }
    }

    return $tree;
}


function findSet(array &$set, int $index) {
    foreach ($set as $k => $v) {
        if (in_array($index, $v)) {
            return $k;
        }
    }

    return false;
}

function unionSet(array &$set, int $i, int $j) {
    $a = $set[$i];
    $b = $set[$j];
    unset($set[$i], $set[$j]);
    $set[] = array_merge($a, $b);
}

$graph = [
    [0, 3, 1, 6, 0, 0],
    [3, 0, 5, 0, 3, 0],
    [1, 5, 0, 5, 6, 4],
    [6, 0, 5, 0, 0, 2],
    [0, 3, 6, 0, 0, 6],
    [0, 0, 4, 2, 6, 0],
];

kruskal($graph);
