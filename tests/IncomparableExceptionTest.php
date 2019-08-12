<?php

namespace PhpCommon\Comparison\Tests;

use PhpCommon\Comparison\IncomparableException;
use PHPUnit\Framework\TestCase;

/**
 * Class IncomparableExceptionTest.
 * @package PhpCommon\Comparison\Tests
 */
class IncomparableExceptionTest extends TestCase
{
    /**
     * @expectedException \PhpCommon\Comparison\IncomparableException
     * @expectedExceptionMessage Unable to compare "string" with "integer".
     * @expectedExceptionCode 100
     *
     * @testdox The forType() method creates an exception with a pre-formatted message for incomparable types
     */
    public function testForTypeCreatesAnExceptionForIncomparableTypes()
    {
        $previous = new \Exception();
        $exception = IncomparableException::forType('string', 1, 100, $previous);
        $this->assertSame($previous, $exception->getPrevious());

        throw $exception;
    }

    /**
     * @expectedException \PhpCommon\Comparison\IncomparableException
     * @expectedExceptionMessage Unable to compare "string" with "stdClass".
     *
     * @testdox The forType() uses the fully qualified name of the class for identifying objects in the message
     */
    public function testForTypeUseTheClassNameForIdentifyingObjects()
    {
        throw IncomparableException::forType('string', new \stdClass());
    }
}
