<?php

/**
 * Leetcode 649 implemented with array
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
                if ($senator == 'R' && in_array($key, $radiant)) {
                    array_shift($dire);
                    array_shift($radiant);
                    $radiant[] = $key;
                }
                if ($senator == 'D' && in_array($key, $dire)) {
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

