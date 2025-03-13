<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {
    /**
     * @param ListNode $head
     * @return Boolean
     */
    function hasCycle($head) {
        $slow = $head;
        $fast = $head;

        if ($head->next = null) {
            return false;
        }

        while ($slow != null && $fast != null) {
            $slow = $slow->next;
            $fast = $fast->next?->next ?? null;

            if ($fast == null) return false;

            if ($slow == $fast->next) {
                return true;
            }
        }

        return false;
    }
}

$head = new ListNode(3);
$node = (new ListNode(2));
$head->next = $node;

$ult = new ListNode(3);
$node->next = $ult;
//$ult->next = $head;


print_r($head);
$result = (new Solution())->hasCycle($head);

print_r($result);