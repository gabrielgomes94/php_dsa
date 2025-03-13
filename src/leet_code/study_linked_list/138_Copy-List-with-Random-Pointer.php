<?php

/**
 * Definition for a Node.
 * class Node {
 *     public $val = null;
 *     public $next = null;
 *     public $random = null;
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->next = null;
 *         $this->random = null;
 *     }
 * }
 */

class Solution {
    /**
     * @param Node $head
     * @return Node
     */
    function copyRandomList($head) {
        $current = $head;
        $newList = null;
        $newListTail = null;

        while($current) {
            if ($newList == null) {
                $newList = new Node($current->val);
                $newList->next = null;
                $newListTail = $newList;
            } else {
                $node = new Node($current->val);
                $newListTail->next = $node;
                $newListTail = $node;
            }

            $current = $current->next;
        }

        $currentN = $newList;
        $current = $head;

        while($current && $currentN) {
            if ($current->random === null) {
                $current = $current->next;
                $currentN = $currentN->next;

                continue;
            }

            $random = $current->random;
            $indexRandom = 1;
            $currentR = $head;
            while ($currentR) {
                if ($currentR === $random) {
                    break;
                }
                $indexRandom++;
                $currentR = $currentR->next;
            }

            $currentM = $newList;
            $indexNewList = 1;
            while ($currentM) {
                if ($indexNewList === $indexRandom) {
                    $currentN->random = $currentM;
                    break;
                }

                $indexNewList++;
                $currentM = $currentM->next;
            }

            $current = $current->next;
            $currentN = $currentN->next;
        }

        return $newList;
    }
}