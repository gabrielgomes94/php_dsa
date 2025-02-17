<?php

class Exercicio841
{
    /**
     * @param Integer[][] $rooms
     * @return Boolean
     */
    function canVisitAllRooms($rooms): bool {
        $visited = [];
        $this->dfs($rooms, $visited, 0);

        return count($visited) == count($rooms);
    }

    function dfs($rooms, &$visited, $node) {
        $visited[$node] = 1;

        foreach ($rooms[$node] as $keys) {
            if ($visited[$keys] ?? false) continue;
            $this->dfs($rooms, $visited, $keys);
        }
    }
}


$rooms = [[1],[2],[3],[]];
$rooms = [[1,3],[3,0,1],[2],[0]];

$result = (new Exercicio841())->canVisitAllRooms($rooms);
echo $result;
