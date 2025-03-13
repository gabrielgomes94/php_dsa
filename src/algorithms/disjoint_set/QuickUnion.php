<?php

namespace disjoint_set;

class QuickUnion
{
    private array $rootArray;

    public function __construct($size)
    {
        for($i = 0; $i < $size; $i++) {
            $this->rootArray[$i] = [$i];
        }
    }

    public function find($x)
    {
        while ($x != $this->rootArray[$x]) {
            $x = $this->rootArray[$x];
        }

        return $x;
    }

    public function union($x, $y)
    {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX != $rootY) {
            $this->rootArray[$rootY] = $rootX;
        }
    }

    public function connected($x, $y)
    {
        return $this->find($x) == $this->find($y);
    }

}