<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 08.12.18
 * Time: 19:30
 *
 * Original Article - https://habr.com/sandbox/70036/
 */

/**
 * Class Node
 *
 * Pointer to particular node of the tree
 */
class Node
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var Node | null
     */
    public $left = null;

    /**
     * @var Node | null
     */
    public $right = null;

    /**
     * Node constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $left
     * @return $this
     */
    public function setLeft($left)
    {
        $this->left = $left;
        return $this;
    }

    /**
     * @return Node|null
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param $right
     * @return $this
     */
    public function setRight($right)
    {
        $this->right = $right;
        return $this;
    }

    /**
     * @return Node|null
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}

class Tree
{
    protected $root = null;

    /**
     * @param Node | null $node
     * @param $subtree | null
     * @return $this
     */
    protected function insertNode(Node $node, &$subtree)
    {
        echo "Trying to insert: {$node->getValue()}\r\n";
        print_r($subtree);
        //If subtree is empty - insert and return $this
        if (is_null($subtree)) {
            $subtree = $node;
            return $this;
        }

        //If Node value less than subtree value - insert to left
        if ($node->getValue() < $subtree->getValue()) {
            return $this->insertNode($node, $subtree->left);
        }

        //If Node value more than subtree value - insert to right
        if ($node->getValue() > $subtree->getValue()) {
            return $this->insertNode($node, $subtree->right);
        }
    }

    /**
     * @param $value
     * @param $subtree
     * @return bool | Node
     */
    protected function &findNode($value, &$subtree)
    {
        // Not found
        if (is_null($subtree)) {
            return false;
        }

        // If searching value less than subtree value - go left
        if ($value < $subtree->getValue()) {
            return $this->findNode($value, $subtree->getLeft());
        }

        // If searching value more than subtree value - go right
        if ($value > $subtree->getValue()) {
            return $this->findNode($value, $subtree->getRight());
        }

        //Not less and not more - ergo equal
        return $subtree;
    }

    /**
     * @param Node $node
     * @return bool
     */
    protected function deleteNode(Node &$node)
    {
        // If Node is final - just delete
        if (is_null($node->getLeft()) && is_null($node->getRight())) {
            $node = null;
            return true;
        }

        // If left subtree is empty - just replace it by right subtree
        if (is_null($node->getLeft())) {
            $node = $node->getRight();
            return true;
        }

        // If right subtree is empty - just replace it by left subtree
        if (is_null($node->getRight())) {
            $node = $node->getLeft();
            return true;
        }

        // If right sub doesn't have left sub - just remove
        if (is_null($node->getRight()->getLeft())) {
            $node->getRight()->setLeft($node->getLeft());
            $node = $node->getRight();
            return true;
        }

        // If subtree is full - move left sub of right value to deleting one and remove left sub of right node recursively
        $node->setValue($node->getRight()->getLeft()->getValue());
        $this->deleteNode($node->getRight()->getLeft());
        return true;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return is_null($this->root);
    }

    /**
     * @param $value
     * @return $this
     */
    public function insert($value)
    {
        $node = new Node($value);
        $this->insertNode($node, $this->root);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function delete($value)
    {
        if ($this->isEmpty()) {
            return false;
        }

        // Searching
        $node = &$this->findNode($value, $this->root);

        // If value was founded - delete
        if ($node) {
            $this->deleteNode($node);
        }

        return $this;
    }
}

$tree = new Tree();
$tree->insert(5)
    ->insert(1)
    ->insert(13)
    ->insert(143)
    ->insert(51)
    ->insert(661)
    ->insert(19)
    ->insert(66)
    ->insert(7)
    ->insert(791)
    ->insert(144)
    ->insert(123)
    ->insert(771);

print_r($tree);