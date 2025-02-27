<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $last = count($nums) - 1;
        $right = $last;
        $left = 0;

        while ($left < $right) {
            $value = $target - $nums[$left];
            if ($nums[$right] == $value) {
                return [$left, $right];
            }

            if ($right == $left + 1) {
                $right = $last;
                $left++;
            } else {
                $right--;
            }
        }

        return [$left, $right];
    }
}

$nums = [2,7,11,15];
$target = 9;

//$nums = [3,2,4];
//$target = 6;

//$nums = [3,3];
//$target = 6;
////
//$nums = [2,7,11,15];
//$target = 26;

$r = (new Solution())->twoSum($nums, $target);
print_r($r);