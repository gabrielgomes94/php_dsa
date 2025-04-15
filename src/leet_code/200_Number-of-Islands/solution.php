<?php

class Solution {

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        $visited = [];
        $numberOfIslands = 0;

        for($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[0]); $j++) {
                $visited[$i][$j] = 0;
            }
        }

        for($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[0]); $j++) {
                if ($grid[$i][$j] == 1 && !$visited[$i][$j]) {
                    $this->bfs($grid, $i, $j, $visited);
                    $numberOfIslands++;
                }
            }
        }

        return $numberOfIslands;
    }

    function bfs($grid, $startI, $startJ, &$visited)
    {
        $queue = new SplQueue();
        $queue->enqueue([$startI, $startJ]);
        $directions = [
            [0, 1],
            [0, -1],
            [1, 0],
            [-1, 0],
        ];

        while(!$queue->isEmpty()) {
            $position = $queue->dequeue();

            foreach ($directions as $direction) {
                $x = $position[0] + $direction[0];
                $y = $position[1] + $direction[1];

                if ($x < 0 || $x >= count($grid) || $y < 0 || $y >= count($grid[0])) {
                    continue;
                }

                if ($visited[$x][$y]) continue;

                if ($grid[$x][$y]) {
                    $visited[$x][$y] = 1;
                    $queue->enqueue([$x, $y]);
                }
            }
        }
    }
}


$grid = [
    ["1","1","1","1","0"],
    ["1","1","0","1","0"],
    ["1","1","0","0","0"],
    ["0","0","0","0","0"]
];

//$grid = [
//    ["1","1","0","0","0"],
//    ["1","1","0","0","0"],
//    ["0","0","1","0","0"],
//    ["0","0","0","1","1"]
//];
$s = (new Solution())->numIslands($grid);
echo $s;