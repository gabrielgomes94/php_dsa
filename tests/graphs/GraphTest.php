<?php


use Graphs\Graph;
use PHPUnit\Framework\TestCase;

class GraphTest extends TestCase
{

    public function testGraph()
    {
        $graph = new Graph();
        $graph->init();

        $path = $graph->breadthFirstSearch(1);

        $this->assertEquals(
            [1, 2, 5, 3, 4, 6],
            $this->getQueueAsArray($path)
        );
    }

    private function getQueueAsArray(SplQueue $queue): array
    {
        while (!$queue->isEmpty()) {
            $data[] = $queue->dequeue();
        }

        return $data ?? [];
    }
}
