<?php
namespace Test\Mock;

use \Pion\Support\Logic\LogicFactory;

class TypeFactory extends LogicFactory
{
    const TYPE_TEST = "TestType";
    const TYPE_TEST_TITLE = "Testing type";

    /**
     * Must be setted on every subclass
     * @var Collection|null
     */
    static protected $list = null;

    /**
     * Create an own colleciton of types
     * @return \Illuminate\Support\Collection
     */
    static function createLogicList()
    {
        return new \Illuminate\Support\Collection([
            self::TYPE_TEST => self::TYPE_TEST_TITLE
        ]);
    }

    /**
     * A namespace where the logic classes are stored. Like
     * __NAMESPACE__."\\Types
     * @return string
     */
    static function logicNamespace()
    {
        return __NAMESPACE__."\\Types";
    }
}