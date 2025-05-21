<?php

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isSubsequence($s, $t) {
        $pointer = 0;

        for($i = 0; $i < strlen($t); $i++) {
            if ($t[$i] == $s[$pointer]) {
                $pointer++;
            }
        }


        return $pointer == strlen($s);
    }
}

$s = "abc";
$s = "axc";
$t = "ahbgdc";

$solution = new Solution();
$r = $solution->isSubsequence($s, $t);
echo $r;