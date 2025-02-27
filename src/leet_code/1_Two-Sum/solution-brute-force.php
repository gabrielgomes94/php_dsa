<?php

namespace leet_code;

class Exercicio1
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $count = count($nums);

        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                if ($i === $j) continue;

                if ($nums[$i] + $nums[$j] == $target) {
                    break 2;
                }
            }
        }

        return [$i, $j];
    }
}


$nums = [2,7,11,15];
$target = 9;

$r = (new Exercicio1())->twoSum($nums, $target);
