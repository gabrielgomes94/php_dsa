<?php

class UnionByRank
{
    public array $rootArray;
    private array $rank;

    public function __construct($size)
    {
        for($i = 0; $i < $size; $i++) {
            $this->rootArray[$i] = $i;
            $this->rank[$i] = 1;
        }
    }

    public function find($x)
    {
        if ($x == $this->rootArray[$x]) return $x;

        return $this->find($this->rootArray[$x]);
    }


    public function union($x, $y)
    {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX == $rootY) return;

        if ($this->rank[$rootX] > $this->rank[$rootY]) {
            $this->rootArray[$rootY] = $rootX;
        } elseif ($this->rank[$rootX] < $this->rank[$rootY]) {
            $this->rootArray[$rootX] = $rootY;
        } else {
            $this->rootArray[$rootX] = $rootY;
            $this->rank[$rootY]++;
        }
    }

    public function connected($x, $y)
    {
        return $this->find($x) == $this->find($y);
    }
}

$ds = new UnionByRank(10);

$ds->union(0, 1);
$ds->union(1, 2);
$ds->union(1, 3);
$ds->union(1, 5);
$ds->union(4, 6);
$ds->union(6, 8);
$ds->union(6, 9);

print_r($ds->rootArray);
print_r(count(array_unique($ds->rootArray)));