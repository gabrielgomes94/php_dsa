<?php

class RecentCounter {
    private array $requests;

    function __construct() {
        $this->requests = [];
    }

    /**
     * @param Integer $t
     * @return Integer
     */
    function ping($t) {
        $this->requests[] = $t;

        foreach ($this->requests as $key => $request) {
            if ($request < $t - 3000) {
                unset($this->requests[$key]);
            }
        }

        return count($this->requests);
    }
}

/**
 * Your RecentCounter object will be instantiated and called as such:
 * $obj = RecentCounter();
 * $ret_1 = $obj->ping($t);
 */