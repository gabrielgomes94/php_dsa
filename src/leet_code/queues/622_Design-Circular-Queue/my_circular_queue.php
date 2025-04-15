<?php

class MyCircularQueue {
    private int $size;
    private int $front;
    private int $rear;

    private array $queue;

    /**
     * @param Integer $k
     */
    function __construct($k) {
        $this->size = $k;
        $this->front = $this->rear = -1;
    }

    /**
     * @param Integer $value
     * @return Boolean
     */
    function enQueue($value) {
        if ($this->isFull()) {
            return false;
        }

        if ($this->isEmpty()) {
            $this->front++;
        }

        $this->rear = ($this->rear + 1) % $this->size;
        $this->queue[$this->rear] = $value;

        return true;
    }

    /**
     * @return Boolean
     */
    function deQueue() {
        if ($this->isEmpty()) {
            return false;
        }

        if ($this->front == $this->rear) {
            $this->front = $this->rear = -1;
            $this->queue[$this->front] = null;
            return true;
        }

        $this->queue[$this->front] = null;
        $this->front = ($this->front + 1) % $this->size;
        return true;
    }

    /**
     * @return Integer
     */
    function Front() {
        return $this->queue[$this->front] ?? -1;
    }

    /**
     * @return Integer
     */
    function Rear() {
        return $this->queue[$this->rear] ?? -1;
    }

    /**
     * @return Boolean
     */
    function isEmpty() {
        return $this->front == -1;

    }

    /**
     * @return Boolean
     */
    function isFull() {
        return ($this->rear + 1) % $this->size === $this->front;
    }
}

/**
 * Your MyCircularQueue object will be instantiated and called as such:
 * $obj = MyCircularQueue($k);
 * $ret_1 = $obj->enQueue($value);
 * $ret_2 = $obj->deQueue();
 * $ret_3 = $obj->Front();
 * $ret_4 = $obj->Rear();
 * $ret_5 = $obj->isEmpty();
 * $ret_6 = $obj->isFull();
 */

$k = 3;
$value = 1;
$obj = new MyCircularQueue($k);
$ret_1 = $obj->enQueue($value);
var_dump($ret_1);
$ret_1 = $obj->enQueue(2);
var_dump($ret_1);

//$ret_1 = $obj->enQueue(4);
//var_dump($ret_1);

//$ret_1 = $obj->enQueue(5);
//var_dump($ret_1);

//$ret_6 = $obj->isFull();
//var_dump($ret_6);

$ret_2 = $obj->deQueue();
var_dump($ret_2);

//$ret_3 = $obj->Front();
//$ret_4 = $obj->Rear();
//$ret_5 = $obj->isEmpty();
$ret_6 = $obj->isFull();