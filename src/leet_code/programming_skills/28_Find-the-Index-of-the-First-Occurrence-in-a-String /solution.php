<?php

class Solution {

    /**
     * @param String $haystack
     * @param String $needle
     * @return Integer
     */
    function strStr($haystack, $needle) {
        $size = strlen($haystack);
        $needleSize = strlen($needle);

        for ($i = 0; $i < $size; $i++) {
            $comparable = '';
            for ($j = 0; $j < $needleSize; $j++) {
                $comparable .= $haystack[$i + $j] ?? '';
            }

            if ($comparable == $needle) {
                return $i;
            }
        }

        return -1;
    }
}

$haystack = "sadbutsad";
$needle = "but";

$haystack = "leetcode";
$needle = "leeto";

$result = (new Solution())->strStr($haystack, $needle);
print_r($result);