<?php
namespace Philippus;

class Foo
{
    private $foo;

    public function setFoo($foo)
    {
        $this->foo = $foo;
    }

    public function getFoo()
    {
        return $this->foo;
    }

    public function getQux()
    {
        return 'qux';
    }

    public function returnProvidedValue($value)
    {
        return $value;
    }
}
