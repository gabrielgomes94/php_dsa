<?php


class Graph {
    private array $adj;
    private array $index;

    private array $low;

    private array $stack;

    private array $inStack;

    public int $scc_count;

    public array $scc;

    public function __construct() {
        $this->adj = [];
        $this->index = [];
        $this->low = [];
        $this->stack = [];
        $this->inStack = [];
        $this->scc_count = 0;
    }

    public function addEdge($from, $to) {
        if (!isset($this->adj[$from])) {
            $this->adj[$from] = [];
        }

        $this->adj[$from][] = $to;
    }


    public function findSCCs() {
        foreach (array_keys($this->adj) as $v) {
            if (!isset($this->index[$v])) {
                $this->strongconnect($v);
            }
        }
    }

    public function strongconnect($v)
    {
        $this->index[$v] = $this->low[$v] = count($this->index);
        $this->stack[] = $v;
        $this->inStack[$v] = true;

        foreach ($this->adj[$v] ?? [] as $w) {
            if (!isset($this->index[$w])) {
                $this->strongconnect($w);
                $this->low[$v] = min($this->low[$v], $this->low[$w]);
            }
            elseif ($this->inStack[$w]) {
                $this->low[$v] = min($this->low[$v], $this->index[$w]);
            }
        }

        if ($this->low[$v] == $this->index[$v]) {
            $this->scc_count++;

            do {
                $w = array_pop($this->stack);
                $this->inStack[$w] = false;
                $this->scc[$this->scc_count][] = $w;
            } while($w != $v);

            print_r($this->scc);
        }
    }
}

$graph = new Graph();
//$graph->addEdge(0, 1);
//$graph->addEdge(1, 2);
//$graph->addEdge(2, 0);
//$graph->addEdge(2, 3);
//$graph->addEdge(3, 3);

$graph->addEdge(0, 1);
$graph->addEdge(0, 2);
$graph->addEdge(1, 0);
$graph->addEdge(1, 2);
$graph->addEdge(2, 0);
$graph->addEdge(2, 1);

$graph->addEdge(1, 3);
$graph->addEdge(3, 1);

$graph->addEdge(3, 4);
$graph->addEdge(3, 5);
$graph->addEdge(4, 3);
$graph->addEdge(4, 5);
$graph->addEdge(5, 4);
$graph->addEdge(5, 3);
//
//$graph->addEdge(4, 1);
//$graph->addEdge(1, 4);
//
//$graph->addEdge(2, 3);
//$graph->addEdge(3, 2);


$graph->findSCCs();

print_r($graph->scc_count);
echo PHP_EOL;
//print_r($graph->scc ?? []);