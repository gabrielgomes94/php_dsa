<?php

/**
 * Leetcode 649 implemented with SPL Queue
 *
 * This solution does not work on TestCase 74 because of Time Limit Exceeded
 */
class Solution {

    /**
     * @param String $senate
     * @return String
     */
    function predictPartyVictory($senate) {
        $radiant = new SplQueue();
        $dire = new SplQueue();

        $senate = str_split($senate);

        foreach ($senate as $key => $senator) {
            if ($senator == 'R') {
                $radiant->enqueue($key);
            } else if($senator == 'D') {
                $dire->enqueue($key);
            }
        }

        while(!$radiant->isEmpty() && !$dire->isEmpty()) {
            foreach ($senate as $key => $senator) {
                if ($senator == 'R' && $this->isInQueue($key, $radiant)) {
                    if (!$dire->isEmpty()) $dire->dequeue();
                    $radiant->dequeue();
                    $radiant->enqueue($key);
                }
                if ($senator == 'D' && $this->isInQueue($key, $dire)) {
                    if (!$radiant->isEmpty()) $radiant->dequeue();
                    $dire->dequeue();
                    $dire->enqueue($key);
                }
            }
        }

        if ($radiant->isEmpty()) return 'Dire';
        return 'Radiant';
    }

    private function isInQueue($key, SplQueue $queue): bool
    {
        $queue->rewind();
        if ($queue->isEmpty()) return false;
        if ($queue->current() === $key) return true;

        while ($queue->current() !== $queue->top()) {
            if ($queue->current() === $key) return true;
            $queue->next();
        }

        return false;
    }
}

$senate = 'RD';
//$senate = 'DRDRR';
//$senate = "DRRDRDRDRDDRDRDR";
//$senate = 'DDRRR';
//$senate = "RR";

$solution = new Solution();
$r = $solution->predictPartyVictory($senate);

print_r($r);

