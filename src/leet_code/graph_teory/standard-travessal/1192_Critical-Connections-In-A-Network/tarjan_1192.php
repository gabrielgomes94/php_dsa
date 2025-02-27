<?php

class Exercicio1192
{
    private array $visited = [];
    private array $low = [];
    private array $index = [];

    private array $criticalConnections = [];
  

    /**
     * @param Integer $n
     * @param Integer[][] $connections
     * @return Integer[][]
     */
    function criticalConnections($n, $connections)
    {
        $graph = $this->initGraph($connections, $n);

        for ($i = 0; $i < $n; $i++) {
            $this->visited[$i] = false;
        }

        for ($i = 0; $i < $n; $i++) {
            if (!$this->visited[$i]) {
                $this->dfs($i, -1, $graph);
            }
        }

        return $this->criticalConnections;
    }

    private function dfs(int $at, int $parent, $graph)
    {
        $this->visited[$at] = true;
        $this->low[$at] = $this->index[$at] = count($this->index);

        foreach ($graph[$at] as $to => $isConnected) {
            if ($to == $parent) continue;

            if (!$this->visited[$to]) {
                $this->dfs($to, $at, $graph);
                $this->low[$at] = min($this->low[$at], $this->low[$to]);

                if ($this->index[$at] < $this->low[$to]) {
                    $this->criticalConnections[] = [$at, $to];
                }
            } else {
                $this->low[$at] = min($this->low[$at], $this->index[$to]);
            }
        }
    }

    private function initGraph(array $connections, $n)
    {
        for ($i = 0; $i < $n; $i++) {
            $graph[$i] = [];
        }

        foreach ($connections as $connection) {
            $graph[$connection[0]][$connection[1]] = 1;
            $graph[$connection[1]][$connection[0]] = 1;
        }

        return $graph;
    }
}

$n = 6;
$connections = [[0,1],[1,2],[2,0],[1,3],[3,4],[4,5],[5,3]];

$result = (new Exercicio1192())->criticalConnections($n, $connections);

print_r($result);