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
     * @return ListNode
     */
    function detectCycle($head) {
        $slow = $head;
        $fast = $head;

        do {
            if ($fast == null || $fast->next == null) return null;

            $slow = $slow->next;
            $fast = $fast->next->next;
            if ($slow === $fast) break;
        } while ($fast && $fast->next);


        $fast = $head;

        while ($slow !== $fast) {
            $slow = $slow->next;
            $fast = $fast->next;
        }

        return $slow;
    }
}

$head = new ListNode(3);
$node = (new ListNode(2));
$head->next = $node;

$ult = new ListNode(1);
$node->next = $ult;
//$ult->next = $head;


//print_r($head);
$result = (new Solution())->hasCycle($head);

print_r($result);