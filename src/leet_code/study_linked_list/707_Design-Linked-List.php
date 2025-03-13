<?php

class MyLinkedList {
    public $val;
    public ?MyLinkedList $next;
    private $head;

    /**
     */
    function __construct() {

    }

    /**
     * @param Integer $index
     * @return Integer
     */
    function get($index) {
        $node = $this->head;
        $count = 0;

        while($node != null) {
            if ($count == $index) {
                return $node->val;
            }

            $count++;
            $node = $node->next;
        }

        return -1;
    }

    /**
     * @param Integer $val
     * @return NULL
     */
    function addAtHead($val) {
        $node = new MyLinkedList();
        $node->val = $val;

        if ($this->head == null) {
            $node->next = null;
            $this->head = $node;
        } else {
            $aux = $this->head;
            $node->next = $aux;
            $this->head = $node;
        }
    }

    /**
     * @param Integer $val
     * @return NULL
     */
    function addAtTail($val)
    {
        if ($this->head == null) {
            $this->addAtHead($val);

            return;
        }

        $currentNode = $this->head;

        while($currentNode != null) {
            if ($currentNode->next == null) {
                $newNode = new MyLinkedList();
                $newNode->val = $val;
                $newNode->next = null;
                $currentNode->next = $newNode;

                break;
            }
            $currentNode = $currentNode->next;
        }
    }

    /**
     * @param Integer $index
     * @param Integer $val
     * @return NULL
     */
    function addAtIndex($index, $val) {
        if ($index == 0) {
            $this->addAtHead($val);
            return;
        }

        $node = $this->head;
        $prev = $this->head;
        $count = 0;

        while($node != null ||  $count == $index) {
            if ($count == $index) {
                $newNode = new MyLinkedList();
                $newNode->val = $val;
                $newNode->next = $node;
                $prev->next = $newNode;
            }

            $count++;
            $prev = $node;
            $node = $node->next;
        }
    }

    /**
     * @param Integer $index
     * @return NULL
     */
    function deleteAtIndex($index) {
        $node = $this->head;
        $prev = $this->head;
        $next = $this->head->next;
        $count = 0;

        while($node != null ||  $count == $index) {
            if ($count == $index) {
                break;
            }

            $count++;
            $prev = $node;
            $node = $node->next;
            $next = $node->next;
        }

        if ($index == 0) {
            $this->head = $this->head->next;
        } else {
            $prev->next = $next;
        }
    }
}

/**
 * Your MyLinkedList object will be instantiated and called as such:
 * $obj = MyLinkedList();
 * $ret_1 = $obj->get($index);
 * $obj->addAtHead($val);
 * $obj->addAtTail($val);
 * $obj->addAtIndex($index, $val);
 * $obj->deleteAtIndex($index);
 */

//$obj = new MyLinkedList();
//
//$obj->addAtHead(1);
//$obj->addAtTail(3);
//$obj->addAtTail(2);
//$obj->addAtIndex(2, 4);
//$obj->deleteAtIndex(2);
//$ret_1 = $obj->get(1);
//print_r($ret_1) . PHP_EOL;
//print_r($obj);

$obj = new MyLinkedList();
$obj->addAtHead(7);
$obj->addAtHead(2);
$obj->addAtHead(1);
$obj->addAtIndex(3, 0);
$obj->deleteAtIndex(2);
$obj->addAtHead(6);
$obj->addAtTail(4);
$ret_1 = $obj->get(4);

//print_r($ret_1) . PHP_EOL;
//
//print_r($obj);

$obj->addAtHead(4);
$obj->addAtIndex(5, 0);
$obj->addAtHead(6);
//print_r($obj);


$obj = new MyLinkedList();
$obj->addAtHead(1);
$obj->addAtTail(2);
$obj->addAtIndex(1, 2);
$ret_1 = $obj->get(1);
$obj->deleteAtIndex(0);
$ret_1 = $obj->get(0);
//
//print_r($obj);


$obj = new MyLinkedList();
$obj->addAtIndex(0, 10);
$obj->addAtIndex(0, 20);
$obj->addAtIndex(1, 30);
$ret_1 = $obj->get(0);

//print_r($obj);




$obj = new MyLinkedList();
$obj->addAtIndex(1, 0);
$ret_1 = $obj->get(0);
print_r($obj);