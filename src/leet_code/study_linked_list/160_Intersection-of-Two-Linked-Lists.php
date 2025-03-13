<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class Solution {
    /**
     * @param ListNode $headA
     * @param ListNode $headB
     * @return ListNode
     */
    function getIntersectionNode($headA, $headB) {
        $currentA = $headA;

        $nodes = [];

        while ($currentA) {
            $currentB = $headB;
            while ($currentB) {
                if ($currentB === $currentA) return $currentB;

                $currentB = $currentB->next;
            }
            $currentA = $currentA->next;
        }

        return null;
    }
}