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
    function deleteMiddle($head) {
        $prev = $slow = $fast = $head;

        while ($fast && $fast->next) {
            $fast = $fast->next->next;
            $prev = $slow;
            $slow = $slow->next;
        }

        $prev->next = $slow->next;
        return $head;
    }
}