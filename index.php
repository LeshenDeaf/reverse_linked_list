<?php

define('STOP_STATISTICS', true);
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
$GLOBALS['APPLICATION']->RestartBuffer();
//header('Content-Type: application/json');


class Node
{
	public int $value;
	private ?Node $nextNode = null;

	public function __construct(int $value)
	{
		$this->value = $value;
	}

	public function getNextNode(): ?Node
	{
		return $this->nextNode;
	}

	public function setNextNode(Node $nextNode): void
	{
		$this->nextNode = $nextNode;
	}

	public function clearNextNode(): void
	{
		$this->nextNode = null;
	}
}

class NodeList
{
	private ?Node $head;
	private ?Node $currentNode;
	private ?Node $tail;

	public function __construct(Node $head)
	{
		$this->setHead($head);
		$this->currentNode = $this->head;
	}

	public function getHead(): Node
	{
		return $this->head;
	}

	public function getTail(): ?Node
	{
		return $this->tail;
	}

	public function getCurrentNode(): Node
	{
		return $this->currentNode;
	}

	public function setHead(Node $head): void
	{
		$this->head = $head;
		$this->detectTail();
	}

	private function detectTail(?Node $inputNode = null): void
	{
		$this->tail = $inputNode ?? $this->head;
		while ($node = $this->tail->getNextNode()) {
			$this->tail = $node;
		}
	}

	public function addNode(Node $node): void
	{
		$this->tail->setNextNode($node);
		$this->detectTail($this->tail);
	}

	public function deleteList(): void
	{
		unset($this->head);
		unset($this->currentNode);
		unset($this->tail);
	}

	public function deleteNode(): void
	{
		if ($this->currentNode === $this->head) {
			$this->head = $this->head->getNextNode();

			if (!$this->head) {
				$this->deleteList();
			}
		}

		$node = $this->head;
		while ($node->getNextNode() !== $this->currentNode) {
			$node = $node->getNextNode();
		}

		$node->setNextNode($this->currentNode->getNextNode());
		$this->currentNode = $node;
	}

	public function print(): void
	{
		$node = $this->head;
		do {
			echo "$node->value <br>";
		} while ($node = $node->getNextNode());
	}

	public function next(): void
	{
		$this->currentNode = $this->currentNode->getNextNode();
	}

	public function reverse(): void
	{
		$this->currentNode = $this->head;

		$this->head = $this->tail;
		$this->tail = $this->currentNode;

		$this->reverseNodes($this->currentNode);

		$this->tail->clearNextNode();
		$this->currentNode = $this->head;
	}

	private function reverseNodes(Node $node): void
	{
		if ($node->getNextNode()) {
			$this->reverseNodes($node->getNextNode());
			$node->getNextNode()->setNextNode($node);
		}
	}
}

$firstNode = new Node(0);
$secondNode = new Node(1);
$thirdNode = new Node(2);
$forthNode = new Node(3);

$firstNode->setNextNode($secondNode);
$thirdNode->setNextNode($forthNode);

$firstNode->getNextNode()->setNextNode($thirdNode);

$nodeList = new NodeList($firstNode);

$fifthNode = new Node(4);

$nodeList->addNode($fifthNode);

echo 'Normal list:<br>';
$nodeList->print();

echo '<hr>';
$nodeList->reverse();

echo 'Reversed list:<br>';
$nodeList->print();
echo '<br>';
