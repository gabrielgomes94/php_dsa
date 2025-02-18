<?php

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference($s, $t) {
        $tSize = strlen($t);
        $sSize = strlen($s);
        $totalSSum = $totalTSum = 0;

        for ($i = 0; $i < $tSize; $i++) {
            $totalTSum += ord($t[$i]);
        }

        for ($i = 0; $i < $sSize; $i++) {
            $totalSSum += ord($s[$i]);
        }

        return chr($totalTSum - $totalSSum);
    }
}

$s = 'abcd';
$t = 'abcde';

$s = '';
$t = 'y';

$s = 'a';
$t = 'aa';


$result = (new Solution())->findTheDifference($s, $t);
print_r($result);