<?php
namespace Pion\Support\Logic\Traits;

use Pion\Support\Logic\LogicFactory;

/**
 * Trait ModelSingleLogicTrait
 *
 * @package Pion\Support\Traits
 */
trait ModelSingleLogicTrait {

    use ModelLogicTrait;

    /**
     * Creates a logic factory based on the
     *
     * @param string $classValue
     * @param string $attributeName
     * @return LogicFactory
     */
    public function createLogicFactory($classValue, $attributeName)
    {
        $class = $this->getLogicFactoryClass();
        return new $class($classValue);
    }

    /**
     * Returns desired logic factory class
     * @return string
     */
    abstract public function getLogicFactoryClass();
}