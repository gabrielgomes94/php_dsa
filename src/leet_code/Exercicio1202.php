<?php

namespace leet_code;

class Exercicio1202
{
    private array $disjointSet = [];

    /**
     * @param String $s
     * @param Integer[][] $pairs
     * @return String
     */
    function smallestStringWithSwaps($s, $pairs) {
        $stringArray = str_split($s);
        $size = count($stringArray);
        $this->initDisjointSet($size, $pairs);
        $groups = [];

        foreach ($this->disjointSet as $element => $root) {
            $groups[$this->find($element)][$element] = $stringArray[$element];
        }

        foreach ($groups as $key => $group) {
            sort($groups[$key], SORT_ASC);
        }

        $string = '';
        for ($i = 0; $i < $size; $i++) {
            $character = array_shift($groups[$this->find($i)]);
            $string = $string . $character;
        }

        return $string;
    }

    function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootY != $rootX) {
            $this->disjointSet[$rootY] = $rootX;
        }
    }

    function find($x)
    {
        if ($this->disjointSet[$x] == $x) return $x;

        return $this->disjointSet[$x] = $this->find($this->disjointSet[$x]);
    }

    private function initDisjointSet($size, $pairs)
    {
        // Fill disjoint set
        for ($i = 0; $i < $size; $i++) {
            $this->disjointSet[$i] = $i;
        }

        foreach ($pairs as $pair) {
            $this->union($pair[0], $pair[1]);
        }
    }
}

$s = 'dcab';
$pairs = [[0, 3], [1, 2]];
//$pairs = [[0, 3], [1, 2], [0, 2]];
echo $result = (new Exercicio1202())->smallestStringWithSwaps($s, $pairs);
