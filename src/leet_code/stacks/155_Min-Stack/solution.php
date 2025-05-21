<?php

class MinStack {
    private array $stack = [];
    private array $minimum;

    /**
     */
    function __construct() {

    }

    /**
     * @param Integer $val
     * @return NULL
     */
    function push($val) {
        if (empty($this->stack)) {
            $this->minimum[] = $val;
            $this->stack[] = $val;
        } else {
            if ($val <= end($this->minimum)) {
                $this->minimum[] = $val;
            } else {
                $this->minimum[] = end($this->minimum);
            }

            $this->stack[] = $val;
        }
    }

    /**
     * @return NULL
     */
    function pop() {
        $element = array_pop($this->stack);
        array_pop($this->minimum);

        return $element;
    }

    /**
     * @return Integer
     */
    function top() {
        return end($this->stack);
    }

    /**
     * @return Integer
     */
    function getMin() {
        return end($this->minimum);
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($val);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */


//$obj = new MinStack();
//$obj->push(-3);
//$obj->push(0);
//$obj->push(-2);
//echo $obj->getMin();
//echo PHP_EOL;
//
//echo $obj->pop();
//echo PHP_EOL;
//
//$ret_3 = $obj->top();
//echo $ret_3;
//echo PHP_EOL;
//
//$ret_4 = $obj->getMin();
//echo $ret_4;

$obj = new MinStack();
$obj->push(-2);
$obj->push(0);
$obj->push(-1);
echo $obj->getMin();
echo PHP_EOL;

$ret_3 = $obj->top();
echo $ret_3;
echo PHP_EOL;

echo $obj->pop();
echo PHP_EOL;



$ret_4 = $obj->getMin();
echo $ret_4;