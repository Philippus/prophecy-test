<?php

class MockingFeaturesWithPropecyTest extends PHPUnit_Framework_TestCase {

    /* @var \Prophecy\Prophet $prophet */
    private $prophet;

    /**
     * Dummy objects are objects that extend and/or implement preset classes/interfaces by overriding
     * all their public methods.
     */
    public function testProphecyCanProvideADummy()
    {
        $foo = $this->prophet->prophesize('Philippus\Foo');

        $bar = new Philippus\Bar($foo->reveal());

        $this->assertNull($bar->getFoo());
    }

    /**
     * A stub is an object double, which doesn't have any expectations about the object behavior,
     * but when put in specific environment, behaves in specific way.
     */
    public function testProphecyCanProvideAStub()
    {
        $testValue = 'test';

        $foo = $this->prophet->prophesize('Philippus\Foo');

        $foo->getFoo()->willReturn($testValue);

        $bar = new Philippus\Bar($foo->reveal());

        $this->assertEquals($testValue, $bar->getFoo());
    }

    /**
     * A mock is an object double, which has expectations about the object behavior
     */
    public function testProphecyCanProvideAMock()
    {
        $foo = $this->prophet->prophesize('Philippus\Foo');

        $foo->getFoo()->willReturn('test');

        $bar = new Philippus\Bar($foo->reveal());

        $foo->getFoo()->shouldBeCalled();
    }

    /**
     * A spy is an object double, and _we_ can have expectations about the object behavior after the fact
     */
    public function testProphecyCanProvideASpy()
    {
        $foo = $this->prophet->prophesize('Philippus\Foo');

        $bar = new Philippus\Bar($foo->reveal());

        $foo->getFoo()->shouldBeCalled();
    }

    /**
     * Prophecy does not allow you to partially mock a class
     * @expectedException Prophecy\Exception\Call\UnexpectedCallException
     */
    public function testProphecyCanNotProvideAPartialMock()
    {
        $testValue = 'test';

        $foo = $this->prophet->prophesize('Philippus\Foo');

        $foo->getFoo()->willReturn($testValue);

        $revealedFoo = $foo->reveal();

        $bar = new Philippus\Bar($revealedFoo);
        $bar->getQux($revealedFoo);
    }

    /**
     * Bonus: Prophecy does not allow you to mock a method that is not available in the original class
     * @expectedException Prophecy\Exception\Doubler\MethodNotFoundException
     */
    public function testProphecyPreventsMockingAnUnknownMethod()
    {
        $foo = $this->prophet->prophesize('Philippus\Foo');

        $foo->getBaz()->willReturn();
    }

    protected function setup()
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    protected function tearDown()
    {
        $this->prophet->checkPredictions();
    }
}
