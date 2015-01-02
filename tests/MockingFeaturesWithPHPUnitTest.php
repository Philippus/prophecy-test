<?php

class MockingFeaturesWithPHPUnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * Dummy objects are objects that extend and/or implement preset classes/interfaces by overriding
     * all their public methods.
     */
    public function testPhpunitCanProvideADummy()
    {
        $foo = $this->getMock('Philippus\Foo');

        $bar = new Philippus\Bar($foo);

        $this->assertNull($bar->getFoo());
    }

    /**
     * A stub is an object double, which doesn't have any expectations about the object behavior,
     * but when put in specific environment, behaves in specific way.
     */
    public function testPhpunitCanProvideAStub()
    {
        $testValue = 'test';

        $foo = $this->getMock('Philippus\Foo', array('getFoo'));

        $foo->expects($this->any())
            ->method('getFoo')
            ->will($this->returnValue($testValue));

        $bar = new Philippus\Bar($foo);

        $this->assertEquals($testValue, $bar->getFoo());
    }

    /**
     * A mock is an object double, which has expectations about the object behavior
     */
    public function testPhpunitCanProvideAMock()
    {
        $foo = $this->getMock('Philippus\Foo', array('getFoo'));

        $foo->expects($this->atLeastOnce()) // here we can check the behaviour
            ->method('getFoo')
            ->will($this->returnValue('test'));

        $bar = new Philippus\Bar($foo);
    }

    /**
     * A spy is an object double, and _we_ can have expectations about the object behavior after the fact
     */
    public function testPhpunitCanProvideASpy()
    {
        $foo = $this->getMock('Philippus\Foo', array('getFoo'));

        $foo->expects($spy = $this->any())
            ->method('getFoo');

        $bar = new Philippus\Bar($foo);

        $invocations = $spy->getInvocations();
        $this->assertEquals(1, count($invocations));
    }

    /**
     * PHPUnit allows you to partially mock a class
     */
    public function testPhpunitCanProvideAPartialMock()
    {
        $foo = $this->getMock('Philippus\Foo', array('getFoo'));

        $foo->expects($this->atLeastOnce()) // here we can check the behaviour
            ->method('getFoo')
            ->will($this->returnValue('test'));

        $bar = new Philippus\Bar($foo);

        $this->assertEquals('qux', $bar->getQux($foo));
    }

    /**
     * PHPUnit allows you to mock a method that is not available in the original class
     */
    public function testPhpunitDoesNotPreventMockingAnUnknownMethod()
    {
        $foo = $this->getMock('Philippus\Campagnenaam', array('getBaz'));

        $foo->expects($this->any())
            ->method('getBaz')
            ->will($this->returnValue(true));

        $this->assertTrue(true);
    }
}
