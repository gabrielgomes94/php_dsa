<?php

class Exercicio1129
{

    /**
     * @param Integer $n
     * @param Integer[][] $redEdges
     * @param Integer[][] $blueEdges
     * @return Integer[]
     */
    function shortestAlternatingPaths($n, $redEdges, $blueEdges) {
        $graph = [];
        $pred = [];
        $visited = [];

        for ($i = 0; $i < $n; $i++) {
            $distance[$i] = -1;
            $pred[$i] = [];
            $graph[$i] = [];
        }

        foreach ($redEdges as $edge) {
            $graph[$edge[0]][$edge[1]][] = 'R';
            $visited[$edge[0]][$edge[1]]['R'] = false;
        }

        foreach ($blueEdges as $edge) {
            $graph[$edge[0]][$edge[1]][] = 'B';
            $visited[$edge[0]][$edge[1]]['B'] = false;
        }

//        echo PHP_EOL;
//        print_r($graph);
//        echo PHP_EOL;

        $queue = new SplQueue();
        $node = 0;
        $queue->enqueue([0]);
        $distance[$node] = 0;

        while (!$queue->isEmpty()) {
            $element = $queue->dequeue();
            $node = $element[0];
            $previousColor = $element[1] ?? null;

            foreach ($graph[$node] as $adjacency => $edgeColors) {
                foreach ($edgeColors as $color) {
                    if ($visited[$node][$adjacency][$color] ?? false) continue;

                    if ($color != $previousColor) {
                        // Validar se o nó já nao tá com a distancia preenchida
                        $pred[$adjacency][] = [$node, $color];
                        $queue->enqueue([$adjacency, $color]);
                        $visited[$node][$adjacency][$color] = true;
                    }
                }
            }
        }

        for ($i = $n - 1; $i >= 0; $i--) {
            $distance[$i] = $this->getDistance($pred, $i);
        }

        return $distance;
    }

    private function getDistance(array $pred, $i)
    {
        $node = $i;
        $distance = 0;
        $parentColor = null;

        while ($node != 0) {
            $parents = $pred[$node];

            foreach ($parents as $parent) {
                $parentNode = $parent[0];
                $edgeColor = $parent[1];


                if ($edgeColor != $parentColor) {
                    $distance = $distance + 1;
                    $node = $parentNode;
                    $parentColor = $edgeColor;
                    break;
                }
            }

            if ($distance == 0) return -1;
        }

        return $distance;
    }
}

$n = 3;
$redEdges = [[0, 1], [1, 2]];
$blueEdges = [];

//$redEdges = [[0,1]];
//$blueEdges = [[2,1]];

//
//$redEdges = [[0,1]];
//$blueEdges = [[1,2]];

//$expected = [0,1,2];


//$redEdges = [[0,1],[0,2]];
//$blueEdges = [[1,0]];

$n = 5;
//$redEdges = [[0,1],[1,2],[2,3],[3,4]];
//$blueEdges = [[1,2],[2,3],[3,1]];


$redEdges = [[2,2],[0,4],[4,2],[4,3],[2,4],[0,0],[0,1],[2,3],[1,3]];
$blueEdges = [[0,4],[1,0],[1,4],[0,0],[4,0]];
$result = (new Exercicio1129())->shortestAlternatingPaths($n, $redEdges, $blueEdges);

print_r($result);