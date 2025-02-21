<?php

class Solution {
    private $paths;
    private $path;

    private $visited;

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function shortestBridge($grid) {
        $size = count($grid);
        $this->visited = [];
        $islands = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $this->visited[$i][$j] = 0;
            }
        }

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($grid[$i][$j] && !$this->visited[$i][$j]) {
                    $islands[] = $this->bfs($grid, $i, $j, $this->visited);
                }
            }
        }

        foreach ($islands[0] as $terrain) {
            for ($i = 0; $i < $size; $i++) {
                for ($j = 0; $j < $size; $j++) {
                    $this->visited[$i][$j] = 0;
                }
            }

            $this->path = [];
            $this->dfs($terrain, $islands[0], $islands[1], $grid);
        }

        $count = [];
        foreach ($this->paths as $path) {
            $count[] = count($path);
        }

//        return $this->paths;
        return min($count) - 2;
    }

    function bfs($grid, $startX, $startY, &$visited) {
        $queue = [];
        $queue[] = [$startX, $startY];
        $islands = [];
        $islands[] = [$startX, $startY];

        while (!empty($queue)) {
            $node = array_shift($queue);
            $visited[$node[0]][$node[1]] = 1;

            if (
                ($grid[$node[0] + 1][$node[1]] ?? false)
                && !($visited[$node[0] + 1][$node[1]] ?? false)
            ) {
                $queue[] = [$node[0] + 1, $node[1]];
                $islands[] = [$node[0] + 1, $node[1]];
            }

            if (
                ($grid[$node[0] - 1][$node[1]] ?? false)
                && !($visited[$node[0] - 1][$node[1]] ?? false)
            ) {
                $queue[] = [$node[0] - 1, $node[1]];
                $islands[] = [$node[0] - 1, $node[1]];
            }

            if (
                ($grid[$node[0]][$node[1] + 1] ?? false)
                && !($visited[$node[0]][$node[1] + 1] ?? false)
            ) {
                $queue[] = [$node[0], $node[1] + 1];
                $islands[] = [$node[0], $node[1] + 1];
            }

            if (
                ($grid[$node[0]][$node[1] - 1] ?? false)
                && !($visited[$node[0]][$node[1] - 1] ?? false)
            ) {
                $queue[] = [$node[0], $node[1] - 1];
                $islands[] = [$node[0], $node[1] - 1];
            }
        }

        return $islands;
    }

    function dfs($node, $fromIsland, $toIsland, $grid)
    {
        if (
            $node[0] >= count($grid)
            || $node[1] >= count($grid)
            || $node[0] < 0
            || $node[1] < 0
        ) {
            for ($i = 0; $i < count($grid); $i++) {
                for ($j = 0; $j < count($grid); $j++) {
                    $this->visited[$i][$j] = 0;
                }
            }

            return;
        }

        $this->visited[$node[0]][$node[1]] = 1;
        $this->path[] = $node;

        if (in_array($node, $toIsland)) {
            $this->paths[] = $this->path;

//            for ($i = 0; $i < count($grid); $i++) {
//                for ($j = 0; $j < count($grid); $j++) {
//                    $this->visited[$i][$j] = 0;
//                }
//            }

            return;
        }

        $rightNode = [$node[0] + 1, $node[1]];
        if (
            !($this->visited[$node[0] + 1][$node[1]] ?? false)
            && !in_array($rightNode, $fromIsland)
        ) {
            $this->dfs($rightNode, $fromIsland, $toIsland, $grid);
        }

        $leftNode = [$node[0] - 1, $node[1]];
        if (
            !($this->visited[$node[0] - 1][$node[1]] ?? false)
            && !in_array($leftNode, $fromIsland)
        ) {
            $this->dfs($leftNode, $fromIsland, $toIsland, $grid);
        }

        $downNode = [$node[0], $node[1] + 1];
        if (
            !($this->visited[$node[0]][$node[1] + 1] ?? false)
            && !in_array($downNode, $fromIsland)
        ) {
            $this->dfs($downNode, $fromIsland, $toIsland, $grid);
        }

        $upNode = [$node[0], $node[1] - 1];
        if (
            !($this->visited[$node[0]][$node[1] - 1] ?? false)
            && !in_array($upNode, $fromIsland)
        ) {
             $this->dfs($upNode, $fromIsland, $toIsland, $grid);
        }
    }
}

$grid = [
    [0,1],
    [1,0]
];

$grid = [
    [0,1,0],
    [0,0,0],
    [0,0,1]
];

//$grid = [
//    [1,1,1,1,1],
//    [1,0,0,0,1],
//    [1,0,1,0,1],
//    [1,0,0,0,1],
//    [1,1,1,1,1]
//];

$result = (new Solution())->shortestBridge($grid);

print_r($result);

//[0, 1, 0, 0, 0];
//[0, 1, 0, 1, 1]
//[]

