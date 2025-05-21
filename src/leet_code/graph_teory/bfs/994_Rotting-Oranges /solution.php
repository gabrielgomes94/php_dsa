<?php

class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function orangesRotting($grid) {
        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[$i]); $j++) {
                if ($grid[$i][$j] == 2) {
                    $distance = $this->bfs($grid, [$i, $j]);
                    break 2;
                }
            }
        }

        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[$i]); $j++) {
                if ($grid[$i][$j] == 1) {
                    return -1;
                }
            }
        }


        if (isset($distance)) {
//            print_r($grid);
            for ($i = 0; $i < count($grid); $i++) {
                for ($j = 0; $j < count($grid[$i]); $j++) {

                    $dist[] = $distance[$i][$j] ?? 0;
                }
            }

            print_r($dist);

            return max($dist ?? []);
        } else  {
            return 0;
        }

    }

    function bfs(&$grid, $node) {
        $directions = [
            [0, 1],
            [1, 0],
            [0, -1],
            [-1, 0]
        ];
        $queue = new SplQueue();
        $queue->enqueue($node);
        $distance = [];
        $distance[$node[0]][$node[1]] = 0;

        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();

            foreach ($directions as $direction) {
                $i = $node[0] + $direction[0];
                $j = $node[1] + $direction[1];

                if ($i < 0 || $i >= count($grid) || $j < 0 || $j >= count($grid[0])) {
                    continue;
                }

                if ($grid[$i][$j] == 1) {
                    $grid[$i][$j] = 2;
                    $queue->enqueue([$i, $j]);
                    $distance[$i][$j] = $distance[$node[0]][$node[1]] + 1;
                }
            }
        }

        print_r($distance);

        return $distance;
    }
}

$grid = [
    [2,1,1],
    [1,1,0],
    [0,1,1]
];


//$grid = [
//    [2,1,1],
//    [0,1,1],
//    [1,0,1]
//];

$grid = [
    [2,1,1],
    [1,1,1],
    [0,1,2]
];

$s = new Solution();
$r = $s->orangesRotting($grid);
print_r($r);
