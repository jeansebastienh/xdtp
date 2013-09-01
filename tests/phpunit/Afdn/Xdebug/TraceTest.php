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
require_once 'Afdn/Xdebug/Trace.php';
/**
 * Afdn_Xdebug_Trace_RecordTest
 *
 * @category   AfdnFramework
 * @package    Xdebug
 * @subpackage Trace
 * @author     Jean-Sébastien H. <jeanseb@au-fil-du.net>
 * @copyright  2011 AuFilDuNet http://www.au-fil-du.net
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Afdn_Xdebug_TraceTest extends PHPUnit_Framework_TestCase
{
    public function testGenerateExecutionTraceWithoutFunctionCallReturnOneNode()
    {

        $service = new Afdn_Xdebug_Trace();
        $main = $service->generateExecutionTrace(dirname(__FILE__) . '/_files/testGenerateExecutionTraceWithoutFunctionCallReturnOneNode');
        $this->assertTrue($main->hasChild());
        $this->assertEquals(200616, $main->memoryUsage());

        // Je pige rien : Failed asserting that <double:5.33921> matches expected <double:5.33921>.
        $this->assertEquals("5.33921", (string)$main->duration());

        $children = $main->getChildren();
        $this->assertFalse($children[0]->hasChild());
    }

    public function testGenerateExecutionTraceWithFunctionCallsReturnNodes()
    {
        $service = new Afdn_Xdebug_Trace();
        $main = $service->generateExecutionTrace(dirname(__FILE__) . '/_files/testGenerateExecutionTraceWithFunctionCallsReturnNodes.txt');
        $this->assertTrue($main->hasChild());
        $this->assertEquals("0.002322", (string) $main->duration());
        $this->assertEquals(112, $main->memoryUsage());

        $this->assertEquals(1, count($main->getChildren()));
        $children = $main->getChildren();
        $this->assertEquals(2, count($children[0]->getChildren()));
    }

    public function testGenerateExecutionTraceFixFS150()
    {
        $service = new Afdn_Xdebug_Trace();
        $main = $service->generateExecutionTrace(dirname(__FILE__) . '/_files/trace.3812899783.xt');
        $this->assertEquals(true, $main->hasChild());
        $this->assertEquals("15.001857", (string) $main->duration());
        $this->assertEquals(12968, $main->memoryUsage());

        $this->assertEquals(2, count($main->getChildren()));
    }
}