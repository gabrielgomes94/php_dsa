<?php

namespace disjoint_set;

class QuickFind
{
    private array $rootArray;

    public function __construct($size)
    {
        for ($i = 0; $i < $size; $size++) {
            $this->rootArray[$i] = $i;
        }
    }

    function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootY != $rootX) {
            foreach ($this->rootArray as $element => $root) {
                if ($this->rootArray[$element] == $rootY) {
                    $this->rootArray[$element] = $rootX;
                }
            }
        }
    }

    function find($x)
    {
        return $this->rootArray[$x];
    }

    function connected($x, $y)
    {
        return $this->find($x) == $this->find($y);
    }

}