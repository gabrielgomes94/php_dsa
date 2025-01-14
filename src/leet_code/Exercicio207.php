<?php

namespace leet_code;

use SplQueue;

class Exercicio207
{
    /**
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Boolean
     */
    function canFinish($numCourses, $prerequisites) {
        $indegrees = array_fill(0, $numCourses, 0);

        $graph = [];
        foreach ($prerequisites as $prerequisite) {
            $graph[$prerequisite[0]][$prerequisite[1]] = 1;
            $indegrees[$prerequisite[1]]++;
        }

        $queue = new SplQueue();

        for ($i = 0; $i < $numCourses; $i++) {
            if ($indegrees[$i] == 0) $queue->enqueue($i);
        }

        $classCount = 0;
        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();

            foreach ($graph[$node] as $n => $val) {
                $indegrees[$n]--;
                if ($indegrees[$n] == 0) {
                    $queue->enqueue($n);
                }
            }

            $classCount++;
        }

        return $classCount == $numCourses;
    }
}

$numCourses = 2;
$prerequisites = [
    [1, 0],
    [0, 1]
];

print_r(
    (new Exercicio207())->canFinish($numCourses, $prerequisites) ? 'true' : 'false'
);