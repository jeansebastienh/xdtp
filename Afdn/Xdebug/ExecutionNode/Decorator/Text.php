<?php
/**
 * PHP execution node text decorator
 *
 * PHP version 5
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
require_once 'Afdn/Xdebug/ExecutionNode/Decorator.php';
/**
 * Afdn_Xdebug_ExecutionNode_Decorator_Text
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_ExecutionNode_Decorator_Text implements Afdn_Xdebug_ExecutionNode_Decorator
{
    const PREFIX    = '--';

    /**
     * @see Afdn_Xdebug_ExecutionNode_Decorator::decorate();
     *
     * @param Afdn_Xdebug_ExecutionNode $node
     *
     * @return string
     */
    public function decorate(Afdn_Xdebug_ExecutionNode $node)
    {
        return $this->_decorate($node, $node->getFunctionName());
    }

    protected function _decorate(Afdn_Xdebug_ExecutionNode $node, $content = '', $prefix = self::PREFIX, $percent = 1)
    {
        foreach ($node->getChildren() as $child) {
            $pourcentage = ($child->duration()/$node->duration()) * $percent;
            $content .= PHP_EOL;
            if ($pourcentage > 0.01) {
                $content .= $prefix . ' ' . number_format($pourcentage * 100, 2) . '% ' . $child->getFunctionName() . PHP_EOL;
                $content = $this->_decorate($child, $content, self::PREFIX . $prefix, $pourcentage);
            }
        }
        return $content;
    }
}