<?php
/**
 * PHP execution node decorator
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
 * Afdn_Xdebug_ExecutionNode_Decorator
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
interface Afdn_Xdebug_ExecutionNode_Decorator
{
    /**
     * Decorate
     *
     * @param Afdn_Xdebug_ExecutionNode $node
     *
     * @return string
     */
    public function decorate(Afdn_Xdebug_ExecutionNode $node);
}