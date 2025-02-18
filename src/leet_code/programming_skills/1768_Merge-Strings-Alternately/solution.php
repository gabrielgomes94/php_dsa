<?php

class Solution {

    /**
     * @param String $word1
     * @param String $word2
     * @return String
     */
    function mergeAlternately($word1, $word2) {
        $mergedString = '';
        $word1Size = strlen($word1);
        $word2Size = strlen($word2);

        $size = max($word1Size, $word2Size);

        for ($i = 0; $i < $size; $i++) {
            $mergedString .= ($word1[$i] ?? '') . ($word2[$i] ?? '');
        }

        return $mergedString;
    }
}

$word1 = 'abc';
$word2 = 'pqr';

$word1 = 'ab';
$word2 = 'pqrs';

$word1 = 'abcd';
$word2 = 'pq';

$result = (new Solution())->mergeAlternately($word1, $word2);
echo $result;