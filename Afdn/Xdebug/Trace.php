<?php
/**
 * Trace record
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
require_once 'Afdn/Xdebug/ExecutionNode.php';
/**
 * Afdn_Xdebug_Trace
 *
 * @category   AfdnFramework
 * @package    Xdebug
 * @subpackage Trace
 * @author     Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright  2011 AuFilDuNet http://www.au-fil-du.net
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_Trace
{
    public function generateExecutionTrace($fileName)
    {
        if (file_exists($fileName) === false) {
            throw new RuntimeException('File does not exists');
        }

        $root = new Afdn_Xdebug_ExecutionNode();
        $currentNode = $root;

        $startLevel = 0;
        $currentLevel = $startLevel;
        foreach (file($fileName) as $line) {
            if (stripos($line, "\t") !== 0 && strlen($line) > 0) {

                $values = preg_split("/\t/", $line);
                if (count($values) < 5) {
                    continue;
                    //throw new RuntimeException("Bad Format");
                }
                if ($values[2] == "0") {
                    if ($values[0] > $currentLevel) {
                        $tmpNode = new Afdn_Xdebug_ExecutionNode($currentNode);
                        $currentNode->addChild($tmpNode);
                        $currentNode = $tmpNode;
                    } else if ($values[0] < $currentLevel) {
                        // N'existe pas si je suis pas une exitString
                        throw new RuntimeException("Impossible");
                    } else if ($values[0] == $currentLevel && $currentLevel > $startLevel) {
                        $tmpNode = new Afdn_Xdebug_ExecutionNode($currentNode->getParent());
                        $currentNode->getParent()->addChild($tmpNode);
                        $currentNode = $tmpNode;
                    }
                } else {
                    if ($values[0] > $currentLevel) {
                        // N'existe pas ici
                        throw new RuntimeException("Impossible");
                    } else if ($values[0] < $currentLevel) {
                        // N'existe pas si je suis pas une exitString
                        $currentNode = $currentNode->getParent();
                    } else if ($values[0] == $currentLevel && $currentLevel > $startLevel) {
                        // Fermons le noeud courant
                    }
                }
                if ($values[2] == "1") {
                    $currentNode->setTimeStop($values[3]);
                    $currentNode->setMemoryStop($values[4]);
                } else {
                    $currentNode->setFunctionName($values[5]);
                    $currentNode->setFunctionNumber($values[1]);
                    $currentNode->setTimeStart($values[3]);
                    $currentNode->setMemoryStart($values[4]);
                    $currentNode->setInternalFunction($values[6] == "0" ? true : false);
                }
                $currentLevel = $values[0];
            }
        }

        foreach ($root->getChildren() as $idx => $child) {
            $root->setFunctionName('{ROOT NODE}');
            $root->setFunctionNumber(-1);
            $root->setInternalFunction(false);
            if ($idx === 0) {
                $root->setTimeStart($child->getTimeStart());
                $root->setMemoryStart($child->getMemoryStart());
            }
            $root->setTimeStop($child->getTimeStop());
            $root->setMemoryStop($child->getMemoryStop());
        }
        return $root;
    }

}