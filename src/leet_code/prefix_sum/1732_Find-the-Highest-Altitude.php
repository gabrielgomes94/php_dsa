<?php
class Solution {

    /**
     * @param Integer[] $gain
     * @return Integer
     */
    function largestAltitude($gain) {
        $altitudes = [];
        $altitudes[0] = 0;

        for ($i = 1; $i <= count($gain); $i++) {
            $altitudes[$i] = $altitudes[$i - 1] + $gain[$i - 1];
        }

        return max($altitudes);

    }
}

$gain = [-5,1,5,0,-7];
$gain = [-4,-3,-2,-1,4,3,2];
$s = new Solution();
$r = $s->largestAltitude($gain);

echo $r;