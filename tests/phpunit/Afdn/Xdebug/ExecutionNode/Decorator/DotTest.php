<?php
/**
 *
 *
 * PHP version 5
 *
 * @category   AfdnFramework
 * @package    Xdebug
 * @subpackage Trace
 * @author     Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright  2011 AuFilDuNet http://www.au-fil-du.net
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Afdn/Xdebug/ExecutionNode/Decorator/Dot.php';
require_once 'Afdn/Xdebug/ExecutionNode.php';
/**
 * Afdn_Xdebug_ExecutionNode_Decorator_DotTest
 *
 * @category   AfdnFramework
 * @package    Xdebug
 * @subpackage Trace
 * @author     Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright  2011 AuFilDuNet http://www.au-fil-du.net
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_ExecutionNode_Decorator_DotTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Afdn_Xdebug_ExecutionNode_Decorator_Dot
     */
    protected $_decorator = null;

    /**
     * @var Afdn_Xdebug_ExecutionNode
     */
    protected $_node = null;

    protected function setUp()
    {
        $this->_decorator = new Afdn_Xdebug_ExecutionNode_Decorator_Dot();
        $this->_node = new Afdn_Xdebug_ExecutionNode();
        $this->_node->setFunctionName('ma-fonction');
        $this->_node->setFunctionNumber(1);
        $this->_node->setMemoryStart(1);
        $this->_node->setMemoryStop(2);
        $this->_node->setTimeStart(10);
        $this->_node->setTimeStop(14);
    }

    public function testDecorateWithoutChildren()
    {
        $this->assertEquals(file_get_contents(dirname(__FILE__) . '/_files/no-children.dot'), $this->_decorator->decorate($this->_node));
    }

    public function testDecorateWithOneChild()
    {
        $node = new Afdn_Xdebug_ExecutionNode();
        $node->setFunctionName('ma-fonction-2');
        $node->setFunctionNumber(2);
        $node->setMemoryStart(1);
        $node->setMemoryStop(2);
        $node->setTimeStart(11);
        $node->setTimeStop(13);
        $this->_node->addChild($node);
        $this->assertEquals(file_get_contents(dirname(__FILE__) . '/_files/one-child.dot'), $this->_decorator->decorate($this->_node));
    }
}