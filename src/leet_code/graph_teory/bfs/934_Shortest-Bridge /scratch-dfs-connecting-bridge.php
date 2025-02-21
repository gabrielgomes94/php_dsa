<?php

function dfs($x, $y, $fromIsland, $toIsland)
{
    if ($x < 0 || $y < 0 || $x >= $this->size || $y >= $this->size) {
        return;
    }

    if ($this->visited[$x][$y] == 1) {
        return;
    }

    $this->visited[$x][$y] = 1;
    $this->path[] = [$x, $y];

    if (in_array([$x, $y], $toIsland)) {
//            print_r(PHP_EOL . '---------------' . PHP_EOL);
        $this->paths[] = $this->path;
        $this->visited[$x][$y] = 1;

        return;
    }

    $this->dfs($x + 1, $y, $fromIsland, $toIsland);
    $this->dfs($x - 1, $y, $fromIsland, $toIsland);
    $this->dfs($x, $y + 1, $fromIsland, $toIsland);
    $this->dfs($x, $y - 1, $fromIsland, $toIsland);

    array_pop($this->path);
}


function bfs($startX, $startY, $grid)
{
    $queue = [];
    $islands = [];
    $queue[] = [$startX, $startY];

    while (!empty($queue)) {
        $node = array_shift($queue);
        $x = $node[0];
        $y = $node[1];

        if ($x < 0 || $y < 0 || $x >= $this->size || $y >= $this->size) {
            continue;
        }

        if ($this->visited[$x][$y] || $grid[$x][$y] === 0) {
            continue;
        }

        $this->visited[$x][$y] = 1;
        $this->islands[] = [$x, $y];
        $queue[] = [$x + 1, $y];
        $queue[] = [$x - 1, $y];
        $queue[] = [$x, $y + 1];
        $queue[] = [$x, $y - 1];
    }
}