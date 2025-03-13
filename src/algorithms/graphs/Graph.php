<?php

namespace Graphs;

use SplQueue;
use SplStack;

class Graph
{
    public array $graph = [];

    private const int VERTEX_COUNT = 6;


    public function init()
    {
        for ($i = 1; $i <= self::VERTEX_COUNT; $i++) {
            $graph[$i] = array_fill(1, self::VERTEX_COUNT, 0);
        }

        $graph[1][2] = $graph[2][1] = 1;
        $graph[1][5] = $graph[5][1] = 1;
        $graph[5][2] = $graph[2][5] = 1;
        $graph[5][4] = $graph[4][5] = 1;
        $graph[4][3] = $graph[3][4] = 1;
        $graph[3][2] = $graph[2][3] = 1;
        $graph[6][4] = $graph[4][6] = 1;

        $this->graph = $graph;
    }

    public function initVisited(): array
    {
        $visited = [];

        for ($i = 1; $i <= self::VERTEX_COUNT; $i++) {
            $visited[$i] = 0;
        }

        return $visited;
    }


    /**
     * @param int $start
     * @return SplQueue BFS's path
     */
    public function breadthFirstSearch(int $start): SplQueue
    {
        $visited = $this->initVisited();
        $nodesToSearch = new SplQueue();
        $path = new SplQueue();

        $nodesToSearch->enqueue($start);
        $visited[$start] = 1;

        while (!$nodesToSearch->isEmpty()) {
            $node = $nodesToSearch->dequeue();
            $path->enqueue($node);

            foreach ($this->graph[$node] as $adjacencyNode => $isConnected) {
                if ($visited[$adjacencyNode]) continue;
                if (!$isConnected) continue;

                $visited[$adjacencyNode] = 1;
                $nodesToSearch->enqueue($adjacencyNode);
            }
        }

        return $path;
    }


    public function depthFirstSearch(int $start): SplQueue
    {
        $visited = $this->initVisited();
        $nodesToSearch = new SplStack();
        $path = new SplQueue();
        $nodesToSearch->push($start);
        $visited[$start] = 1;

        while (!$nodesToSearch->isEmpty()) {
            $node = $nodesToSearch->pop();
            $path->enqueue($node);

            foreach ($this->graph[$node] as $adjacencyNode => $isConnected) {
                if ($visited[$adjacencyNode]) continue;
                if (!$isConnected) continue;

                $visited[$adjacencyNode] = 1;
                $nodesToSearch->push($adjacencyNode);
            }
        }

        return $path;
    }

    public function printBFS(int $start): void
    {
        $path = $this->breadthFirstSearch($start);

        while(!$path->isEmpty()) {
            echo $path->dequeue() . "\t";
        }
    }
}