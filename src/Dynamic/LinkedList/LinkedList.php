<?php

namespace Salazar\PhpDataStructures\Dynamic\LinkedList;

use Exception;

class LinkedList
{
    private $head = null;

    /**
     * @var int
     */
    private $id = 0;

    public function getHead()
    {
        return $this->head;
    }

    public function printAll()
    {
        $node = $this->head;

        while ($node) {
            print_r($node->data->display());

            $node = $node->next;
        }
    }

    public function push(Node $node)
    {
        $node->setId(++$this->id);

        if ($this->head === null) {
            $this->head = $node;
            $node->next = null;

            return;
        }

        $node->next = $this->head;
        $this->head = $node;
    }

    public function insertAfter(int $nodeId, Node $insertedNode)
    {
        $insertedNode->setId(++$this->id);

        $node = $this->head;

        while($node){
            if ($node->getId() === $nodeId) {
                $insertedNode->next = $node->next;
                $node->next = $insertedNode;

                return;
            }

            $node = $node->next;
        }
    }

    /**
     * @throws Exception
     */
    public function sort()
    {
        if(!$this->head){
            throw new Exception("There's nothing to sort");
        }
    }
}