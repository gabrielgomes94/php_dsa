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
        $reversedGraph = [];

        for ($i = 0; $i < $size; $i++) {
            foreach ($graph[$i] as $key => $node) {
                $reversedGraph[$node][] = $i;
            }

            if ($graph[$i] == [] || !isset($reversedGraph[$i])) {
                $reversedGraph[$i] = [];
            }
        }
        $safeNodes = $this->topologicalSort($reversedGraph);
//        print_r($safeNodes);

        return $safeNodes ?? [];
    }

    function topologicalSort(array $matrix){
        $order = new SplQueue();
        $queue = new SplQueue();
        $size = count($matrix);
        $incoming = array_fill(0, $size, 0);

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($matrix[$j][$i] ?? 0) {
                    $incoming[$i]++;
                }
            }

            if ($incoming[$i] == 0) {
                $queue->enqueue($i);
            }
        }

        print_r('00000000000' . PHP_EOL);
print_r($queue);
        $safe = array_fill(0, $size, 0);

        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            $safe[$node] = 1;

            for ($i = 0; $i < $size; $i++) {
                if (($matrix[$node][$i] ?? 0) == 1) {
                    $matrix[$node][$i] = 0;
                    $incoming[$i]--;

                    if ($incoming[$i] == 0) {
                        $queue->enqueue($i);
                    }
                }
            }

            $order->enqueue($node);
        }

        return $order;
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

print_r((new Exercicio802())->eventualSafeNodes($graph));
echo PHP_EOL;