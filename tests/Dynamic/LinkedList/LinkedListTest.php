<?php

namespace Salazar\Tests\Dynamic\LinkedList;

use Salazar\PhpDataStructures\Dynamic\LinkedList\LinkedList;
use Salazar\Tests\Dynamic\LinkedList\Stubs\Person;
use PHPUnit\Framework\TestCase;
use Salazar\PhpDataStructures\Dynamic\LinkedList\Node;

class LinkedListTest extends TestCase
{
    const ASSERTIONS_PATH = __DIR__ . '/assertions';

    private function getPersonList()
    {
        $person = [];

        $person[0] = new Person('Lara', 'Moravich', '23.12.1945', 'woman');
        $person[1] = new Person('Sebastian', 'Saprun', '18.09.2003', 'man');
        $person[2] = new Person('John', 'Week', '05.07.1997', 'male');

        return $person;
    }

    public function testPush()
    {
        $linkedList = new LinkedList();
        $person = $this->getPersonList();

        $linkedList->push(new Node($person[2]));
        $linkedList->push(new Node($person[0]));
        $linkedList->push(new Node($person[1]));

        // check all data was added in the right order
        $node = $linkedList->getHead();
        $result = [];

        while ($node) {
            $data = $node->data;
            $result[] = $data->getFullName() . " : " . $data->getAge();
            $node = $node->next;
        }

        $expectedResult = ['Sebastian Saprun : 20', 'Lara Moravich : 78', 'John Week : 26'];

        $this->assertEquals($expectedResult, $result);
    }

    public function testPrintAll()
    {
        $linkedList = new LinkedList();
        $person = $this->getPersonList();

        $linkedList->push(new Node($person[1]));
        $linkedList->push(new Node($person[0]));
        $linkedList->push(new Node($person[2]));

        $linkedList->printAll();

        $this->expectOutputString(file_get_contents(self::ASSERTIONS_PATH . '/print_all/expected.txt'));
    }

    public function testInsertAfter()
    {
        // inserting in the middle
        $linkedList = new LinkedList();

        $person = $this->getPersonList();

        $linkedList->push(new Node($person[0]));
        $linkedList->push(new Node($person[1]));
        $linkedList->push(new Node($person[2]));

        $newPerson = new Person("Charlie", "Bigheady", "03.05.1985", 'man');

        $linkedList->insertAfter(2, new Node($newPerson));

        $node = $linkedList->getHead();

        $result = '';

        while ($node) {
            $result .= $node->getId();

            $node = $node->next;
        }

        $this->assertEquals('3241', $result);

        // inserting in the end

        $linkedList = new LinkedList();

        $person = $this->getPersonList();

        $linkedList->push(new Node($person[0]));
        $linkedList->push(new Node($person[1]));
        $linkedList->push(new Node($person[2]));

        $newPerson = new Person("Charlie", "Bigheady", "03.05.1985", 'man');

        $linkedList->insertAfter(1, new Node($newPerson));

        $node = $linkedList->getHead();

        $result = '';

        while ($node) {
            $result .= $node->getId();

            $node = $node->next;
        }

        $this->assertEquals('3214', $result);

        // inserting after non-existent node. In this case a new node can't be inserted
        $linkedList = new LinkedList();

        $person = $this->getPersonList();

        $linkedList->push(new Node($person[0]));
        $linkedList->push(new Node($person[1]));
        $linkedList->push(new Node($person[2]));

        $newPerson = new Person("Charlie", "Bigheady", "03.05.1985", 'man');

        $linkedList->insertAfter(5, new Node($newPerson));

        $node = $linkedList->getHead();

        $result = '';

        while ($node) {
            $result .= $node->getId();

            $node = $node->next;
        }

        $this->assertEquals('321', $result);
    }

    public function testMergeList()
    {

    }
}