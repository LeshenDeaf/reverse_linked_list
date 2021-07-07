# One way linked list reverse

There're two __classes__:
* ```Node``` -- the element of list
* ```NodeList``` -- the list of nodes. It provides additional methods to work with them.

Public __methods__:
* getters and setters
* ```public function clearNextNode(): void``` - sets ```nextNode``` value to ```null```

## Node
It is elementary class, the foundation of further code. 
__Fields__: 
* ```public int $value;``` - the value of node. To simplify project it is int but can be changed to mixed type.
* ```private ?Node $nextNode = null;``` - a reference to the next node.

## NodeList
The list itself. Provides methods to work with nodes comfortable.  

__Fields__:
* ```private ?Node $head;``` head of list. Also known as first element
* ```private ?Node $currentNode;``` - current node. A.k.a. pointer to current node
* ```private ?Node $tail;``` - tail of list. Last element

Public __methods__:
* getters and setters
* ```public function setHead(Node $head): void``` - head setter. Also can be used for creating new list. Method automatically detects tail and resets the ```currentNode```.
* ```public function addNode(Node $node): void``` - add new node to the list ending. New node's tail is new tail. In other words, if provided node has own sequence of next nodes, the last one of them would be the new tail.
* ```public function deleteList(): void``` - sets all fields values to null
* ```public function deleteNode(): void``` - deletes the current node. If current node is head, new head would be a next node. If there's no next node, then the list would be deleted. 
* ```public function print(): void``` - prints list
* ```public function next(): void``` - moves ```currentNode``` to a next node
* ```public function reverse(): void``` - reverses the list. For example, _A->B->...->N_ will be _N->...->B->A_
