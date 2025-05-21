<?php

class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height) {
        $left = 0;
        $right = count($height) - 1;
        $total = 0;

        while ($left <= $right) {
            $h = min($height[$left], $height[$right]);
            $w = $right - $left;
            $area = $h *  $w;
            $total = max($area, $total);

            if ($height[$right] > $height[$left]) {
                $left++;
            } else {
                $right--;
            }
        }

        return $total;
    }
}

$heights = [1,8,6,2,5,4,8,3,7];

$solution = new Solution();
$r = $solution->maxArea($heights);
echo $r;