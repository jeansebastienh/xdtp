<?php
/**
 * PHP execution node DOT decorator
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
 * Afdn_Xdebug_ExecutionNode_Decorator_Dot
 *
 * @category  AfdnFramework
 * @package   Xdebug
 * @author    Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright 2011 AuFilDuNet http://www.au-fil-du.net
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_ExecutionNode_Decorator_Dot implements Afdn_Xdebug_ExecutionNode_Decorator
{
    const EDGE_STMT = '"%d" -> "%d" [label="%s" style="setlinewidth(2.0)" color="#AAAAFF"];';
    const NOTE_STMT = '"%d" [label="%s"];';

    /**
     * @see Afdn_Xdebug_ExecutionNode_Decorator::decorate();
     *
     * @param Afdn_Xdebug_ExecutionNode $node
     *
     * @return string
     */
    public function decorate(Afdn_Xdebug_ExecutionNode $node)
    {
        $before = 'digraph G {' . PHP_EOL;
        $before .= 'rankdir=TB;' . PHP_EOL;
        $before .= 'edge [labelfontsize=12];' . PHP_EOL;
        $before .= 'node [shape=box, style=filled];' . PHP_EOL;
        $after = '}';
        return $before . $this->_decorate($node) . $after;
    }

    protected function _decorate(Afdn_Xdebug_ExecutionNode $node, $content = '', $percent = 1)
    {
        $content .= sprintf(self::NOTE_STMT, $node->getFunctionNumber(), $node->getFunctionName()) . PHP_EOL;

        foreach ($node->getChildren() as $child) {
            $pourcentage = ($child->duration()/$node->duration()) * $percent;
            if ($pourcentage > 0.01) {
                $content .= sprintf(self::EDGE_STMT, $node->getFunctionNumber(), $child->getFunctionNumber(), number_format($pourcentage * 100, 2) . "%") . PHP_EOL;
                $content = $this->_decorate($child, $content, $pourcentage);
            }
        }
        return $content;
    }
}