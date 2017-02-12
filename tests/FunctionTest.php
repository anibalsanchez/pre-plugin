<?php

namespace Pre;

use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase
{
    public function testMacroFunctions()
    {
        // this repo registers its own macro file

        $this->assertEquals(1, count(getMacroPaths()));

        $expected = realpath(__DIR__ . "/../src/macros.pre");
        $actual = realpath(getMacroPaths()[0]);

        $this->assertEquals($expected, $actual);

        // what happens when we register another?

        $expected = "foo/bar/baz";
        addMacroPath($expected);

        $this->assertEquals(2, count(getMacroPaths()));

        $actual = getMacroPaths()[1];

        $this->assertEquals($expected, $actual);

        // can we remove it again?

        removeMacroPath("foo/bar/baz");

        $this->assertEquals(1, count(getMacroPaths()));
    }

    public function testCustomMacro()
    {
        addMacroPath(__DIR__ . "/Fixture/macros.pre");

        $fixture = new Fixture\Fixture();

        $expected = "hello chris";
        $actual = $fixture->bar("chris");

        $this->assertEquals($expected, $actual);
    }
}