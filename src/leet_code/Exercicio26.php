<?php

namespace leet_code;

class Exercicio26
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums) {
        $data = [];
        foreach ($nums as $key => $num) {
            if ($this->bsearch_in_array($num, $data) >= 0) {
                unset($nums[$key]);
                continue;
            }

            $data[] = $num;
        }

        return count($nums);
    }

    function bsearch_in_array($needle, $nums): int
    {
        $begin = 0;
        $end = count($nums) - 1;

        while ($begin <= $end) {
            $mid = floor((($begin + $end)/ 2));

            if ($nums[$mid] == $needle) {
                return $mid;
            }

            if ($nums[$mid] < $needle) {
                $begin = $mid + 1;
            } else {
                $end = $mid - 1;
            }
        }

        return -1;
    }
}

$nums = [1, 1, 2];
$nums = [0,0,1,1,1,2,2,3,3,4];
echo (new Exercicio26())->removeDuplicates($nums);