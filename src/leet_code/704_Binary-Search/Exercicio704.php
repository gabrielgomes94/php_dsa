<?php

namespace leet_code;

class Exercicio704
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {
        $size = count($nums);

        return $this->bsearch($nums, $target, 0, $size - 1);
    }

    function bsearch($nums, $target, $start, $end)
    {
        while ($start <= $end) {
            $middle = (int) floor(($end + $start)/2);

            if ($nums[$middle] > $target) {
                $end = $middle - 1;
            }
            elseif ($nums[$middle] < $target) {
                $start = $middle + 1;
            }
            else {
                return $middle;
            }
        }


        return -1;
    }
}

$nums = [-1,0,3,5,9,12];
$target = 9;
$result = (new Exercicio704())->search($nums, $target);
print_r($result);