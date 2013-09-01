<?php
/**
 * PHP execution node
 *
 * PHP version 5
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Afdn/Xdebug/ExecutionNode.php';
/**
 * Afdn_Xdebug_ExecutionNodeTest
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_ExecutionNodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Afdn_Xdebug_ExecutionNode
     */
    protected $node;

    protected function setUp()
    {
        $this->node = new Afdn_Xdebug_ExecutionNode();
    }

    public function testHasChildWithNoChildReturnFalse()
    {
        $this->assertEquals(false, $this->node->hasChild());
    }

    public function testHasChildWithChildrenReturnTrue()
    {
        $this->node->addChild(new Afdn_Xdebug_ExecutionNode());
        $this->assertEquals(true, $this->node->hasChild());
    }

    public function testDuration()
    {
        $this->node->setTimeStart(1.5);
        $this->node->setTimeStop(5.6);
        $this->assertEquals(4.1, $this->node->duration());
    }

    public function testMemoryUsage()
    {
        $this->node->setMemoryStart(43584);
        $this->node->setMemoryStop(44984);
        $this->assertEquals(1400, $this->node->memoryUsage());
    }

    public function testGetChildrenWithoutChildReturnZero()
    {
        $this->assertEquals(0, count($this->node->getChildren()));
    }

    public function testAddChild()
    {
        $this->node->addChild(new Afdn_Xdebug_ExecutionNode());
        $this->node->addChild(new Afdn_Xdebug_ExecutionNode());
        $this->assertEquals(2, count($this->node->getChildren()));
    }

    public function testGetParentWithoutParentReturnNull()
    {
        $this->assertEquals(null, $this->node->getParent());
    }

    public function testGetParentWithParentReturnExceptedNode()
    {
        $child = new Afdn_Xdebug_ExecutionNode($this->node);
        $this->assertEquals($this->node, $child->getParent());
    }

    public function testXetterInternalNode()
    {
        $this->assertTrue($this->node->setInternalFunction(true)->isInternalFunction());
    }

    public function testisInternalFunctionDefaultStatus()
    {
        $this->assertFalse($this->node->isInternalFunction());
    }
}