<?php

namespace disjoint-set;

class PathCompression
{
    public array $rootArray;
    private array $rank;


    function __construct(int $size) {
        for($i = 0; $i < $size; $i++) {
            $this->rootArray[$i] = $i;
            $this->rank[$i] = 1;
        }
    }


    public function find($x) {
        if ($x == $this->rootArray[$x]) return $x;

        return $this->rootArray[$x] = $this->find($this->rootArray[$x]);
    }

    public function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX == $rootY) return;

        if ($this->rank[$rootX] < $this->rank[$rootY]) {
            $this->rootArray[$rootY] = $rootX;
        } elseif ($this->rank[$rootY] < $this->rank[$rootX]) {
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

    public function count()
    {
        $this->baseRoot = [];
        $size = count($this->rootArray);

        for ($i = 0; $i < $size; $i++) {
            $root = $this->find($i);

            // Hashmap
            if (!($this->baseRoot[$root] ?? false)) $this->baseRoot[$root] = 1;
        }

        return count($this->baseRoot);
    }
}

$ds = new PathCompression(10);

$ds->union(0, 1);
$ds->union(1, 2);
$ds->union(1, 3);
$ds->union(1, 5);
$ds->union(4, 6);
$ds->union(6, 8);
$ds->union(6, 9);

echo $ds->count();
