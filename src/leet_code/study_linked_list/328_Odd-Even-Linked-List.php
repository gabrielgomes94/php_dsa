<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function oddEvenList($head) {
        $current = $head;
        $index = 1;
        $oddP = $head;

        while ($current) {
            $index++;
            if ($current->next == null) $lastIndex = $index;
            $current = $current->next;
        }

        $current = $head;
        $index = 1;

        while ($current  && $index < $lastIndex) {
            $node = new ListNode();
            $node->val = $current->val;

            if ($index % 2 != 0) {
                $node->next = $oddP->next;
                $oddP = $node;
            } else {
                $tail = $current;
                while ($tail->next) {
                    $tail = $tail->next;
                }

                $node->next = null;
                $tail->next = $node;
                $prev->next = $current->next;
            }

            $index++;
            $prev = $current;
            $current = $current->next;
        }

        return $head;
    }
}