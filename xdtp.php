#!/usr/bin/env php
<?php
require_once 'Afdn/Xdebug/Trace.php';
require_once 'Afdn/Xdebug/ExecutionNode/Decorator/Dot.php';

if (isset($argv) === true && is_array($argv) === true && count($argv) === 2) {
    $service = new Afdn_Xdebug_Trace();
    $node = $service->generateExecutionTrace($argv[1]);
    unset($records);

    $decorator = new Afdn_Xdebug_ExecutionNode_Decorator_Dot();
    echo $decorator->decorate($node);
    unset($node);
} else {
    echo "XdebugTraceParser 0.1.0 by Jean-Sebastien Hedde." . PHP_EOL;
    echo PHP_EOL;
    echo "Usage: xdtp TraceFile" . PHP_EOL;
}