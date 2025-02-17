<?php

namespace leet_code;

use SplQueue;

class Exercicio547
{
    /**
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findCircleNum($isConnected) {
        return $this->search($isConnected);
    }

    function search($isConnected) {
        $size = count($isConnected);
        $visited = array_fill(0, $size, 0);
        $count = 0;

        for ($i = 0; $i < $size; $i++) {
            if ($visited[$i]) {
                continue;
            }

            $this->bfs($isConnected, $i, $visited);
            $count++;
        }

        return $count;
    }

    function bfs($isConnected, $start, &$visited) {
        $path = new SPLQueue();
        $nodesToSearch = new SPLQueue();
        $nodesToSearch->enqueue($start);

        while (!$nodesToSearch->isEmpty()) {
            $node = $nodesToSearch->dequeue();
            $path->enqueue($node);

            foreach ($isConnected[$node] as $adjacencyNode => $link) {
                if ($visited[$adjacencyNode]) continue;
                if (!$link) continue;

                $visited[$adjacencyNode] = 1;
                $nodesToSearch->enqueue($adjacencyNode);
            }
        }

        return $path;
    }
}

$isConnected = [
    [1,1,0],[1,1,0],[0,0,1]
];
//$isConnected = [[1,0,0],[0,1,0],[0,0,1]];

echo (new Exercicio547())->findCircleNum($isConnected);