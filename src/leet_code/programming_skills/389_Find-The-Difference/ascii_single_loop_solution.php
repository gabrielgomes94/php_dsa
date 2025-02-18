<?php

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference($s, $t) {
        $len = strlen($s);
        $sum = ord($t[$len]);

        for ($i = 0; $i < $len; $i++) {
            $sum += -ord($s[$i]) + ord($t[$i]);
        }

        return chr($sum);
    }
}

$s = 'abcd';
$t = 'abcde';

//$s = '';
//$t = 'y';

//$s = 'a';
//$t = 'aa';


$result = (new Solution())->findTheDifference($s, $t);
print_r($result);