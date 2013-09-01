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

/**
 * Afdn_PHP_ExecutionNode
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_ExecutionNode
{
    /**
     * Time elapsed before this func call
     *
     * @var float
     */
    protected $timeStart = 0;

    /**
     * Time elapsed after this func call
     *
     * @var float
     */
    protected $timeStop = 0;

    /**
     * Memory consumption before this node
     *
     * @var int
     */
    protected $memoryStart = 0;

    /**
     * Memory consumption after this node
     *
     * @var int
     */
    protected $memoryStop = 0;

    /**
     * Function number
     *
     * @var int
     */
    protected $functionNumber;

    /**
     * Function name
     *
     * @var string
     */
    protected $functionName;

    /**
     * Internal function flag
     *
     * @var bool
     */
    protected $isInternalFunction = false;

    /**
     * Children nodes
     *
     * @var array
     */
    protected $children = array();

    /**
     * Parent node
     *
     * @var Afdn_Xdebug_ExecutionNode
     */
    protected $parent = null;

    /**
     * Constructor
     *
     * @param Afdn_Xdebug_ExecutionNode $parent OPTIONAL Parent node
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function __construct(Afdn_Xdebug_ExecutionNode $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Has this node children ?
     *
     * @return bool
     */
    public function hasChild()
    {
        return count($this->getChildren()) > 0;
    }

    /**
     * Compute the duration of this function call
     *
     * @return float
     */
    public function duration()
    {
        return $this->getTimeStop() - $this->getTimeStart();
    }

    /**
     * Compute the memory usage of this function call
     *
     * @return int
     */
    public function memoryUsage()
    {
        return $this->getMemoryStop() - $this->getMemoryStart();
    }

    /**
     * Get the time elapsed before this func call
     *
     * @return float
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set the time elapsed before this func call
     *
     * @param float $timeStart
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
        return $this;
    }

    /**
     * Get the time elapsed after this func call
     *
     * @return float
     */
    public function getTimeStop()
    {
        return $this->timeStop;
    }

    /**
     * Set the time elapsed after this func call
     *
     * @param float $timeStop
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setTimeStop($timeStop)
    {
        $this->timeStop = $timeStop;
        return $this;
    }

    /**
     * Get the memory consumption before this node
     *
     * @return int
     */
    public function getMemoryStart()
    {
        return $this->memoryStart;
    }

    /**
     * Set the memory consumption before this node
     *
     * @param int $memoryStart
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setMemoryStart($memoryStart)
    {
        $this->memoryStart = $memoryStart;
        return $this;
    }

    /**
     * Get the memory consumption after this node
     *
     * @return int
     */
    public function getMemoryStop()
    {
        return $this->memoryStop;
    }

    /**
     * Set the memory consumption after this node
     *
     * @param int $memoryStop
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setMemoryStop($memoryStop)
    {
        $this->memoryStop = $memoryStop;
        return $this;
    }

    /**
     * Get the function number
     *
     * @return int
     */
    public function getFunctionNumber()
    {
        return $this->functionNumber;
    }

    /**
     * Set the function number (auto increment on function call)
     *
     * @param int $functionNumber
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setFunctionNumber($functionNumber)
    {
        $this->functionNumber = $functionNumber;
        return $this;
    }

    /**
     * Get the function name
     *
     * @return string
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }

    /**
     * Set the function name
     *
     * @param string $functionName
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setFunctionName($functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }

    /**
     * Is this node an internal function ?
     *
     * @return bool
     */
    public function isInternalFunction()
    {
        return $this->isInternalFunction;
    }

    /**
     * Define this node as an internal function
     *
     * @param bool $isInternalFunction
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function setInternalFunction($isInternalFunction)
    {
        $this->isInternalFunction = $isInternalFunction;
        return $this;
    }

    /**
     * Return the children nodes
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Append a child node
     *
     * @param Afdn_Xdebug_ExecutionNode $node The node to add
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function addChild(Afdn_Xdebug_ExecutionNode $node)
    {
        $this->children[] = $node;
        return $this;
    }

    /**
     * Get the parent node
     *
     * @return Afdn_Xdebug_ExecutionNode
     */
    public function getParent()
    {
        return $this->parent;
    }
}