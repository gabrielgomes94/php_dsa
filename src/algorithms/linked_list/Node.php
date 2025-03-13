<?php

namespace linked_list;

class Node
{
    public $value;
    public Node $next;

    public function __construct($value, $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}