<?php

class Solution {

    /**
     * @param String[] $deadends
     * @param String $target
     * @return Integer
     */
    function openLock($deadends, $target) {
        $begin = "0000";
        $queue = new SplQueue();
        $queue->enqueue($begin);

        $rotations = ["up", "down",];
        $keys = [0, 1, 2, 3];

        $distance = [];
        $distance[$begin] = 0;
        $visited = [];

        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            $visited[$node] = 1;

            if ($node == $target) return $distance[$node];
            if (in_array($node, $deadends)) continue;

            foreach ($keys as $key) {
                foreach($rotations as $rotation) {
                    $rotatedNode = $this->rotate($node, $key, $rotation);
                    $distance[$rotatedNode] = $distance[$node] + 1;

                    if (!($visited[$rotatedNode] ?? 0)) {
                        $queue->enqueue($rotatedNode);
                        $visited[$rotatedNode] = 1;
                    }
                }
            }
        }

        return -1;
    }

    private function rotate($node, $key, $rotation) {
        $number = (int) $node[$key];

        if ($rotation == 'up') {
            if ($number == 9) $number = 0;
            else $number += 1;
        } else {
            if ($number == 0) $number = 9;
            else $number -= 1;
        }

        $node[$key] = (string) $number;
        return $node;
    }
}

$target = "0202";
$deadends = ["0201","0101","0102","1212","2002"];

$target = "0009";
$deadends = ["8888"];

$target = "8888";
$deadends = ["8887","8889","8878","8898","8788","8988","7888","9888"];
//
//
//$target = "8888";
//$deadends = ["0000"];

$target = "0000";
$deadends = ["0201","0101","0102","1212","2002"];

$lock = new Solution();
$r = $lock->openLock($deadends, $target);
print_r($r);

