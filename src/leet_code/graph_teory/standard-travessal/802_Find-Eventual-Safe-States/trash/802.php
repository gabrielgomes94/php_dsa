<?php

namespace leet_code;

use SplQueue;

class Exercicio802
{
    private $graph;
    private $visited;
    private $safeNodes = [];

    private $terminalNodes = [];

    private $inStack = [];

    private $stack = [];

    private $scc = [];
    private $scc_count = 0;

//    private array $visited = [];
    private array $low = [];
    private array $index = [];

    /**
     * @param Integer[][] $graph
     * @return Integer[]
     */
    function eventualSafeNodes($graph)
    {
        $size = count($graph);
        $reversedGraph = [];
        $safeNodes = [];
        $this->visited = array_fill(0, $size, 0);
        $this->graph = $graph;

        for ($i = 0; $i < 1; $i++) {
            $this->visited = array_fill(0, $size, 0);
            $this->inStack = array_fill(0, $size, false);
            $this->index[] = [];
            $this->low[] = [];

            if ($this->dfs($i)) {
//                $this->safeNodes[] = $i;
            }

            echo PHP_EOL;
        }

//        print_r($safeNodes);
        print_r($this->scc);
//        return array_diff($this->safeNodes, $this->scc);
    }

    function dfs($node)
    {
        print($node);
        if ($this->graph[$node] == []) {
            return true;
        }
        $this->visited[$node] = true;
        $this->stack[] = $node;
        $this->inStack[$node] = true;
        $this->low[$node] = $this->index[$node] = count($this->index);



        foreach ($this->graph[$node] ?? [] as $adj) {
            if (!isset($this->index[$adj])) {
                $this->dfs($adj);
                $this->low[$node] = min($this->low[$node], $this->low[$adj] ?? PHP_INT_MAX);
            } elseif ($this->inStack[$adj]) {
                $this->low[$node] = min($this->low[$node], $this->index[$adj]);
            }

            if ($this->index[$node] < $this->low[$adj]  ?? PHP_INT_MAX ) {
                $this->safeNodes[] = [$node, $adj];
            }
        }

        if ($this->low[$node] == $this->index[$node]) {
            $this->scc_count++;

            do {
                $w = array_pop($this->stack);
                $this->inStack[$w] = false;
                $this->scc[] = $w;
            } while($w != $node);
        }
    }
}

$graph = [
    [1, 2],
    [2, 3],
    [5],
    [0],
    [5],
    [],
    []
];

//$graph = [[1,2,3,4],[1,2],[3,4],[0,4],[]];

print_r((new Exercicio802())->eventualSafeNodes($graph));
echo PHP_EOL;