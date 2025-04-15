<?php

/**
 * Leetcode 649 implemented with array
 *
 * This solution uses a better validation logic: instead of validating senator key on his party's array, now it validates if he is the next on queue.
 */
class Solution {

    /**
     * @param String $senate
     * @return String
     */
    function predictPartyVictory($senate) {
        $radiant = [];
        $dire = [];
        $senate = str_split($senate);
        foreach ($senate as $key => $senator) {
            if ($senator == 'R') {
                $radiant[] = $key;
            } else if($senator == 'D') {
                $dire[] = $key;
            }
        }

        while(!empty($radiant) && !empty($dire)) {
            foreach ($senate as $key => $senator) {
                if ($senator == 'R' && $radiant[0] === $key) {
                    array_shift($dire);
                    array_shift($radiant);
                    $radiant[] = $key;
                }
                if ($senator == 'D' && $dire[0] === $key) {
                    array_shift($radiant);
                    array_shift($dire);
                    $dire[] = $key;
                }
            }

        }

        if (empty($radiant)) return 'Dire';
        return 'Radiant';
    }
}


$senate = 'RD';
$senate = 'DRDRR';
$senate = "DRRDRDRDRDDRDRDR";

//$senate = "RR";

$solution = new Solution();
$r = $solution->predictPartyVictory($senate);

print_r($r);

