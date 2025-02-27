<?php

class Exercicio34
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function searchRange($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;
        $position = -1;

        while ($left <= $right) {
            $middle = round(($left + $right) / 2);

            if ($target > $nums[$middle]) {
                $left = $middle + 1;
            }
            elseif ($target < $nums[$middle]) {
                $right = $middle - 1;
            } else {
                $position = $middle;
                break;
            }
        }

        if ($position == -1) {
            return [-1, -1];
        }

        $outRight = $outLeft = true;
        $leftInterval = $position;
        $rightInterval = $position;
        $i = $j = $position;
        while ($outRight || $outLeft) {
            if (($nums[++$i] ?? null) === $target) {
                $rightInterval = $i;
            } else {
                $outRight = false;
            }

            if (($nums[--$j] ?? null) === $target) {
                $leftInterval = $j;
            } else {
                $outLeft = false;
            }
        }

        return [$leftInterval, $rightInterval];
    }
}

$nums = [5,7,7,8,8,10];
$target = 8;
//$target = 6;

//$nums = [];
//$target = 0;

$nums = [1];
$target = 1;

$nums = [0,0,0,1,2,3];
$target = 0;
$result = (new Exercicio34())->searchRange($nums, $target);

print_r($result);