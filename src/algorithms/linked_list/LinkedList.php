<?php

namespace linked_list;

use linked_list\ILinkedList;

class Node
{
    public $value;
    public ?Node $next;

    public function __construct($value, $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}

class LinkedList
{
    public ?Node $head  = null;
    public ?Node $tail = null;

    public function add($value)
    {
        if ($this->head === null) {
            $this->addAtHead($value);
        } else {
            $this->addAtTail($value);
        }
    }

    public function addAt($value, $index)
    {
        if ($index == 0 ) {
            $this->addAtHead($value);
            return;
        }

        $count = 1;
        $current = $this->head;
        $prev = null;

        while ($current) {
            if ($count == $index) {
                $node = new Node($value, $current);
                $prev->next = $node;
                $node->next = $current;

                if ($current->next === null) {
                    $this->tail = $node;
                }

                return;
            }

            $prev = $current;
            $current = $current->next;
            $count++;
        }
    }

    public function addBefore($value, $searchValue)
    {
        $node = new Node($value);

        if ($this->head->value === $searchValue) {
            $node->next = $this->head;
            $this->head = $node;

            return;
        }

        $current = $this->head;
        $previous = null;

        while ($current) {
            if ($current->value === $searchValue) {
                $node->next = $current;
                $previous->next = $node;

                return;
            }

            $previous = $current;
            $current = $current->next;
        }
    }

    public function addAfter($value, $searchValue)    {
        $node = new Node($value);
        $current = $this->head;

        while ($current) {
            if ($current->value === $searchValue) {
                $node->next = $current->next;
                $current->next = $node;

                return;
            }

            $current = $current->next;
        }
    }

    public function addAtTail($value)
    {
        $current = $this->head;

        while ($current && $current->next) {
            $current = $current->next;
        }

        $node = new Node($value);
        $current->next = $node;
        $this->tail = $node;
    }

    public function addAtHead($value)
    {
        if ($this->head === null) {
            $this->head = new Node($value);
            $this->tail = $this->head;
        } else {
            $node = new Node($value, $this->head);
            $this->head = $node;
        }
    }

    public function removeAtHead()
    {
        $this->head = $this->head->next;
    }

    public function removeAtTail()
    {
        $current = $this->head;

        while ($current) {
            if ($current->next === null) {
                $prev->next = null;
                $this->tail = $prev;
                break;
            }

            $prev = $current;
            $current = $current->next;
        }
    }

    public function removeAtIndex($index)
    {
        $current = $this->head;
        $prev = null;
        $count = 0;

        while ($current) {
            if ($count === $index) {
                if ($prev === null) {
                    $this->removeAtHead();
                } elseif ($current === $this->tail) {
                    $prev->next = null;
                    $this->tail = $prev;
                }
                else {
                    $prev->next = $current->next;
                }

                break;
            }

            $count++;
            $prev = $current;
            $current = $current->next;
        }
    }

    public function rotateRight()
    {
        $this->addAtHead($this->tail->value);
        $this->removeAtTail();
    }

    public function rotateLeft()
    {
        $this->addAtTail($this->head->value);
        $this->removeAtHead();
    }

    public function rotateRightMany(int $k)
    {
        if ($k == 0 || $this->head === null) return $this->head;

        $current = $this->head;
        $length = 1;

        while ($current && $current->next) {
            $current = $current->next;
            $length++;
        }

        $k %= $length;

        if ($k == 0) return $this->head;

        $current->next = $this->head;
        $current = $this->head;

        for ($i = 1; $i < $k; $i++) {
            $current = $current->next;
        }

        $this->head = $current->next;
        $current->next = null;
    }

    public function display()
    {
        $current = $this->head;
        echo PHP_EOL;
        while ($current) {
            echo $current->value .  ' -> ';
            $current = $current->next;
        }
        echo PHP_EOL;
    }

    public function getMiddleNode()
    {
        $fast = $slow = $this->head;

        while ($fast && $fast->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $slow;
    }

    public function hasCycle(): bool
    {
        $fast = $slow = $this->head;

        while ($fast && $fast->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;

            if ($slow === $fast) return true;
        }

        return false;
    }

    public function hasCycleBrent()
    {
        $fast = $slow = $this->head;

        if (!$fast || !$fast->next) return false;

        $length = 1;
        $power = 1;
        $fast = $fast->next;

        while($fast && $fast !== $slow) {
            if ($power === $length) {
                $power *= 2;
                $length = 0;
                $slow = $fast;
            }

            $fast = $fast->next;
            $length++;
        }

        if ($fast === null) return false;

        $slow = $fast = $this->head;

        while ($length > 0) {
            $fast = $fast->next;
            $length--;
        }

        while ($fast !== $slow) {
            $fast = $fast->next;
            $slow = $slow->next;
        }

        return $slow;
    }

    public function setCycleAt($index): void
    {
        $current = $this->head;
        $count = 0;

        while ($current) {
            if ($count === $index) {
                $this->tail->next = $current;
                return;
            }

            $count++;
            $current = $current->next;
        }
    }

    public function getAt($index)
    {
        $current = $this->head;
        $count = 0;

        while ($current) {
            if ($count === $index) {
                return $current;
            }

            $count++;
            $current = $current->next;
        }

        return null;
    }

    public function reverse()
    {
        $current = $this->head;
        $prev = null;

        while ($current) {
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;
            $current = $next;
        }

        $this->head = $prev;
    }

    public function toArray()
    {
        $current = $this->head;
        $array = [];

        while ($current) {
            $array[] = $current->value;
            $current = $current->next;
        }

        return $array;
    }
}

$l = new LinkedList();
$l->addAtHead(2);
$l->addAtTail(4);
$l->addAtTail(5);
$l->addAt(56, 3);
//$l->addAt(256, 0);
//$l->addAtHead(111);
//$l->removeAtTail();
//$l->removeAtTail();

$l->addAt(3, 2);
//$l->addAtHead(5);
//$l->removeAtTail();
$l->add(523);
//$l->addAt(3, 2);
$l->add(51);

$l->display();
//$l->rotateRight();
//$l->display();
//$l->rotateRight();
//$l->display();

$l->rotateRightMany(125);
$l->display();

//$l->rotateLeft();
//$l->display();
//
//$l->removeAtIndex(0);
//$l->display();
//$l->removeAtIndex(1);
//$l->display();
//$l->removeAtIndex(5);
//$l->display();

$l->reverse();
$l->display();
//
//$l->addBefore(44, 51);
//$l->addAfter(87, 2);


//$l->display();


//$r = $l->toArray();
//print_r($r);

//$r = $l->getAt(30);
//print_r($r);

//$l->tail->next = $l->head;
//$l->setCycleAt(1);
//$r = $l->getMiddleNode();

//print_r($l);
//
//
//$r = $l->hasCycleBrent();
//print_r($r);
//print_r($r ? 'true' : 'false');