<?php


class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function numSquares($n) {
        $count = 0;
        for ($i = 0; pow($i, 2) <= $n; $i++) {
            for ($j = $i; pow($j, 2) <= $n; $j++) {
                for ($k = $j; pow($k, 2) <= $n; $k++) {
                    for ($l = $k; pow($l, 2) <= $n; $l++) {
                        if (pow($i, 2) + pow($j, 2) + pow($k, 2) + pow($l, 2) == $n) {
                            if ($i > 0) $count++;
                            if ($j > 0) $count++;
                            if ($k > 0) $count++;
                            if ($l > 0) $count++;

                            break 4;
                        }
                    }
                }
            }
        }

        return $count;
    }
}
$n = 43;
$n = 1;
//$n = 112;
$solution = new Solution();
$r = $solution->numSquares($n);

echo $r;
