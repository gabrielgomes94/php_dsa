<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums) {
        $zeroPointer = 0;
        $numberPointer = 0;

        while ($numberPointer < count($nums)) {

            if ($nums[$zeroPointer] == 0 && $nums[$numberPointer] != 0) {
                $aux = $nums[$zeroPointer];
                $nums[$zeroPointer] = $nums[$numberPointer];
                $nums[$numberPointer] = $aux;
                $zeroPointer++;
                $numberPointer++;
                continue;
            }

            if ($nums[$zeroPointer] != 0) $zeroPointer++;
            $numberPointer++;
        }
    }
}

$nums = [0,1,0,3,12];
(new Solution())->moveZeroes($nums);

print_r($nums);