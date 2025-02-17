<?php

namespace leet_code;

use SplQueue;

class Exercicio802
{
    private $safeNodes = [];

    private $terminalNodes = [];
    /**
     * @param Integer[][] $graph
     * @return Integer[]
     */
    function eventualSafeNodes($graph) {
        $size = count($graph);
        $indegrees = array_fill(0, $size, 0);
        $reversedGraph = array_fill(0, $size, []);

        for ($i = 0; $i < $size; $i++) {
            foreach ($graph[$i] as $node) {
                $reversedGraph[$node][] = $i;
                $indegrees[$i]++;
            }
        }

        $queue = [];
        $safeNodes = [];

        for ($i = 0; $i < $size; $i++) {
            if ($indegrees[$i] == 0) $queue[] = $i;
        }

        while(!empty($queue)) {
            $node = array_shift($queue);
            $safeNodes[] = $node;

            foreach ($reversedGraph[$node] as $adj) {
                $indegrees[$adj]--;

                if ($indegrees[$adj] == 0) {
                    $queue[] = $adj;
                }
            }
        }

        sort($safeNodes);

        return $safeNodes ?? [];
    }
}

$graph = [
    [1,2],
    [2,3],
    [5],
    [0],
    [5],
    [],
    []
];

//$graph = [[1,2,3,4],[1,2],[3,4],[0,4],[]];

$graph = [[1,2],[2,3],[5],[0],[5],[],[]];

print_r((new Exercicio802())->eventualSafeNodes($graph));
echo PHP_EOL;