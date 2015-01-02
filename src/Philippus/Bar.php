<?php
namespace Philippus;

class Bar
{
    private $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo->getFoo();
    }

    public function getFoo()
    {
        return $this->foo;
    }

    public function getQux(Foo $foo)
    {
        return $foo->getQux();
    }
}
