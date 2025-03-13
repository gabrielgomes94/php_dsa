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
     * @param Integer $k
     * @return ListNode
     */
    function rotateRight($head, $k) {
        $tail = null;
        $current = $head;

        while($current) {
            $current = $current->next;

            if ($current->next == null) {
                $tail = $current;
            }
        }

        for ($i = 0; $i < $k; $i++) {
            $tail = $head;
            while($current) {
                if ($current->next == null) {
                    $tail = $current;
                }

                $current = $current->next;
            }

            $tail->next = $head;
            $head = $tail;
        }

        return $head;
    }
}
