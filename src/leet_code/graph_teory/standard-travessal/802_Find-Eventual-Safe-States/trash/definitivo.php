<?php

class Exercicio802
{
    function eventualSafeNodes($graph)
    {
        $size = count($graph);
        $reversedGraph = [];
        $safeNodes = [];
        $incoming = [];
        $visited = [];

        for ($i = 0; $i < $size; $i++) {
            $reversedGraph[$i] = [];
            $visited[$i] = false;
        }

        for ($i = 0; $i < $size; $i++) {
            foreach ($graph[$i] as $adj) {
                $reversedGraph[$adj][] = $i;
            }

//            if ($graph[$i] == []) {
//                $reversedGraph[$i] = [];
//            }
        }

        for ($i = 0; $i < $size; $i++) {
            $incoming[$i] = count($reversedGraph[$i]);

            if ($incoming[$i] == 0) {
                $queue[] = $i;
            }
        }

        print_r($incoming);
//        print_r($queue);

        while (!empty($queue)) {
            $node = array_shift($queue);
            $visited[$node] = true;
            print_r($incoming);
            echo PHP_EOL;
            print_r($node);
            echo PHP_EOL;
            echo PHP_EOL;


            for ($i = 0; $i < $size; $i++) {
//                $adjacents = $reversedGraph[$i];
                if ($visited[$i]) {
                    continue;
                }

                $incoming[$i]--;


                if ($incoming[$i] == 0) {
                    $queue[] = $i;
                }
//                foreach ($adjacents as $adj) {
//                    if ($visited[$adj]) {
//                        continue;
//                    }
//
//
//                }
            }
        }



//        print_r($graph);
//        print_r($incoming);
//        print_r($queue);

        return $safeNodes;
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
