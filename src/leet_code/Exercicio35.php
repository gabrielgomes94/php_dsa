<?php

class Exercicio35 {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function searchInsert($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;

        while ($left <= $right) {
            $middle = round(($left + $right) / 2);

            if ($target > $nums[$middle]) {
                $left = $middle + 1;
            }
            elseif ($target < $nums[$middle]) {
                $right = $middle - 1;
            }
            else {
                $targetPosition = $middle;
                break;
            }
        }

        if (empty($targetPosition)) {
            return $left;
        }

        return $targetPosition;
    }
}


$nums = [1, 3, 5, 6];
$target = 5;
$target = 2;
$target = 7;
$result = (new Exercicio35())->searchInsert($nums, $target);

print_r($result);