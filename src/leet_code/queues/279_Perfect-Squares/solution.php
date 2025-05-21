<?php

class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function numSquares($n) {
        $queue = [];
        $count = [];

        for ($i = floor(sqrt($n)); $i >= 1; $i--) {
            $square = pow($i, 2);

            if ($square <= $n) {
                $queue[] = $square;
            }
        }

        foreach ($queue as $q) {
            $rest = $n % $q;

            if ($rest == 0) {
                $count[] = $n / $q;
            }
        }

        $clonedQ = $queue;

        while (!empty($clonedQ)) {
            $number = array_shift($clonedQ);
            $value = 0;
            $c = 0;
            $deb = '';

            while ($value != $n) {
                if ($value + $number > $n) {
                    $number = array_shift($queue);
                }  else {
                    $deb .= ' +' . (string) $number;
                    $value += $number;
                    $c++;
                }
            }

            print_r($deb . '=======> ' . $c . PHP_EOL . PHP_EOL);
            $count[] = $c;
            $queue = $clonedQ;
        }

        print_r($count);

        return min($count);
    }
}

$n = 12;
$n = 13;
$n = 14;
$n = 15;
$n = 16;
$n = 17;
$n = 17;
$n = 19;
$n = 43;
$solution = new Solution();
$r = $solution->numSquares($n);

echo $r;
