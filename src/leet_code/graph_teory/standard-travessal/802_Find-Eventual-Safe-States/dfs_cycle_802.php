<?php

class Exercicio802
{
    private int $size;
    private array $visited;
    private array $inStack;
    private array $graph;


    /**
     * @param Integer[][] $graph
     * @return Integer[]
     */
    function eventualSafeNodes($graph)
    {
        $safeNodes = [];
        $this->graph = $graph;
        $this->size = count($graph);
        $this->inStack = $this->fillArray();

        foreach ($graph as $node => $adjacents) {
            $this->visited = $this->fillArray();

            if (!$this->dfs($node)) {
                $safeNodes[] = $node;
            }
        }

        return $safeNodes;
    }

    function dfs($node): bool
    {
        $this->visited[$node] = 1;
        $this->inStack[$node] = 1;

        foreach ($this->graph[$node] as $adjacent) {
            if ($this->visited[$adjacent]) {
                if ($this->inStack[$adjacent]) {
                    return true;
                }

                continue;
            }

            if ($this->dfs($adjacent)) {
                return true;
            }
        }

        $this->inStack[$node] = 0;

        return false;
    }

    public function fillArray(): array
    {
        return array_fill(0, $this->size, 0);
    }
}

$graph = [[1,2,3,4],[1,2],[3,4],[0,4],[]];
//$graph = [[1,2],[2,3],[5],[0],[5],[],[]];

print_r((new Exercicio802())->eventualSafeNodes($graph));
echo PHP_EOL;