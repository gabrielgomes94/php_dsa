<?php

use leet_code\Exercicio547;

class DisjointSet547
{
    /**
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findCircleNum($isConnected) {
        $size = count($isConnected);

        // Inicia o Disjoint Set com todos os elementos separados a princípio.
        for ($i = 0; $i < $size; $i++) {
            $root[$i] = $i;
        }


        // Aqui as ligações são analisadas e os nós são unificados
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($isConnected[$i][$j]) {
                    $root = $this->union($root, $i, $j);
                }
            }
        }

        return count(array_unique($root));
    }

    function find($rootArray, $x) {
        return $rootArray[$x];
    }

    function union($rootArray, $x, $y) {
        $x = $this->find($rootArray, $x);
        $y = $this->find($rootArray, $y);

        foreach ($rootArray as $element => $root) {
            if ($root == $y) {
                $rootArray[$element] = $x;
            }
        }

        return $rootArray;
    }
}

$isConnected = [
    [1,1,0],[1,1,0],[0,0,1]
];
$isConnected = [[1,0,0],[0,1,0],[0,0,1]];



$isConnected = [[1,0,0,1],[0,1,1,0],[0,1,1,1],[1,0,1,1]];
echo (new DisjointSet547())->findCircleNum($isConnected);