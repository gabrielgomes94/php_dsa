<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $aux = [];

        foreach ($nums as $pos => $num) {
            if (isset($aux[$num]) && $target - $num == $nums[$aux[$num]]) {
                return [$aux[$num], $pos];
            }

            $aux[$target - $num] = $pos;
        }

        return [];
    }
}

$nums = [2,7,11,15];
$target = 9;

//$nums = [3,2,4];
//$target = 6;

//$nums = [3,3];
//$target = 6;

$nums = [2,7,11,15];
$target = 26;


$r = (new Solution())->twoSum($nums, $target);
print_r($r);