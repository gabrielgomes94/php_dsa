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
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $current = $head;
        $count = 1;

        while($current && $current->next) {
            $count++;
            $current =$current->next;
        }

        $current = $head;
        $index = 0;
        while($current && $current->next) {
            if ($count - $n == $index) {
                $prev->next = $current->next;
                break;
            }

            $index++;
            $prev = $current;
            $current = $current->next;
        }

        return $head;
    }
}
