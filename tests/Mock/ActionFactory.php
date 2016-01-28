<?php
namespace Tests\Mock;

use Pion\Support\Logic\LogicFactory;
use Illuminate\Support\Collection;

/**
 * Class ActionFactory
 *
 * Example of different factory.
 *
 * @package Test\Mock
 */
class ActionFactory extends LogicFactory
{

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
        return new Collection([
            "TestAction" => "Action"
        ]);
    }

    /**
     * A namespace where the logic classes are stored. Like
     * __NAMESPACE__."\\Types
     * @return string
     */
    static function logicNamespace()
    {
        return __NAMESPACE__."\\Actions";
    }
}