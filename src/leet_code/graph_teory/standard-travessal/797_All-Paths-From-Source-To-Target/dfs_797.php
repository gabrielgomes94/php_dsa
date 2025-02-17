<?php

class Exercicio797
{
    private $paths;
    private $visited;
    private $path;
    private $graph;

    /**
     * @param Integer[][] $graph
     * @return Integer[][]
     */
    function allPathsSourceTarget($graph) {
        $n = count($graph);
        $destiny = $n - 1;
        $this->graph = $graph;

        for ($i = 0; $i < $n; $i++) {
            $this->visited[$i] = false;
        }

        $this->dfs(0, $destiny);

        return $this->paths ?? [];
    }


    function dfs($node, $destiny, $path = [])
    {
        $this->path[] = $node;
        $this->visited[$node] = true;

        if ($node == $destiny) {
            print(' . ');
            $this->paths[] = $this->path;
            array_pop($this->path);

            for ($i = 0; $i < count($this->visited); $i++) $this->visited[$i] = 0;

            return;
        }

        foreach ($this->graph[$node] as $adjacency) {
            if ($this->visited[$adjacency]) continue;
            $this->dfs($adjacency, $destiny, $path);
        }
        array_pop($this->path);
    }
}


$graph = [[1, 2],[3],[3],[]];


//$graph = [[4,3,1],[3,2,4],[3],[4],[]];
$result = (new Exercicio797())->allPathsSourceTarget($graph);


print_r($result);