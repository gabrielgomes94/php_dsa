<?php

class Exercicio1376
{
    /**
     * @param Integer $n
     * @param Integer $headID
     * @param Integer[] $manager
     * @param Integer[] $informTime
     * @return Integer
     */
    function numOfMinutes($n, $headID, $manager, $informTime) {
        $graph = [];
        $distance = [];
        $visited = [];

        for ($i = 0; $i < $n; $i++) {
            $graph[$i] = [];
            $distance[$i] = 0;
            $visited[$i] = false;
        }

        for ($i = 0; $i < $n; $i++) {
            if ($manager[$i] == -1) continue;
            $graph[$manager[$i]][$i] = $informTime[$manager[$i]];
        }

        $queue = [];
        $queue[] = $headID;

        while (!empty($queue)) {
            $node = array_shift($queue);
            $visited[$node] = true;

            foreach ($graph[$node] as $adj => $timeDistance) {
                if ($visited[$adj]) continue;

                $distance[$adj] = $distance[$node] + $timeDistance;
                $queue[] = $adj;
            }
        }

        return max($distance);
    }
}

$informTime = [0];
$manager = [-1];
$headId = 0;
$n = 1;

//$informTime = [0, 0, 1, 0, 0, 0];
//$manager = [2, 2, -1, 2, 2, 2];
//$headId = 2;
//$n = 6;


$result = (new Exercicio1376())->numOfMinutes($n, $headId, $manager, $informTime);

print_r($result);