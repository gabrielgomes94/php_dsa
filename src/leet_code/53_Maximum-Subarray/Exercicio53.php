<?php

namespace leet_code;

class Exercicio53
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $best_sum = $nums[0];
        $current_sum = 0;

        foreach ($nums as $num) {
            $current_sum = max($num, $num + $current_sum);
            $best_sum = max($best_sum, $current_sum);
        }

        return $best_sum;
    }
}

//$subarray = [-2,1,-3,4,-1,2,1,-5,4];
//$subarray = [-1];
$subarray = [5,4,-1,7,8];
echo $q = (new Exercicio53)->maxSubArray($subarray);