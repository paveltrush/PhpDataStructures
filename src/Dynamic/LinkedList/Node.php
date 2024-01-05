<?php

namespace Salazar\PhpDataStructures\Dynamic\LinkedList;

use Salazar\PhpDataStructures\Contracts\DataInterface;

class Node
{
    /**
     * @var mixed
     */
    public $data;
    /**
     * @var Node|null
     */
    public $next;

    /**
     * @var int
     */
    private $id = 0;

    public function __construct(DataInterface $data)
    {
        $this->data = $data;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}