<?php

namespace linked_list;

interface ILinkedList
{
    public function add($value);

    public function addAt($value, $index);

    public function addBefore($value, $searchValue);

    public function addAfter($value, $searchValue);

    public function addAtTail($value);

    public function addAtHead($value);

    public function removeAtHead();

    public function removeAtTail();

    public function removeAtIndex($index);

    public function rotateRight();

    public function rotateLeft();

    public function rotateRightMany(int $k);

    public function display();

    public function getMiddleNode();

    public function hasCycle(): bool;

    public function hasCycleBrent();

    public function setCycleAt($index): void;

    public function getAt($index);

    public function reverse();

    public function toArray();
}