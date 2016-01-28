<?php
namespace Pion\Support\Logic\Traits;

use Pion\Support\Logic\LogicFactory;

/**
 * Trait ModelLogicTrait
 *
 * @package Pion\Support\Traits
 */
trait ModelLogicTrait {

    /**
     * The default logic attribute name that will be used for the class value
     * @var string
     */
    protected $logicAttributeName = "logic";

    /**
     * The cache for logic classses
     * @var array
     */
    protected $cachedLogicClasses = [];

    /**
     * Returns the logic factory.
     *
     * @param string|null $attribute    the used attribute from the model to use as a class. When null, the default
     * property will be used. Enables multiple logic usage in model.
     *
     * @return LogicFactory
     */
    public function getLogicFactory($attribute = null)
    {
        // get the attribute name
        $attributeKey = $this->getLogicAttributeName($attribute);

        // check cached vvalue
        if (!isset($this->cachedLogicClasses[$attributeKey])) {
            // create the logic factory with the value and the attribute key
            $this->cachedLogicClasses[$attributeKey] = $this->createLogicFactory($this->{$attributeKey}, $attributeKey);
        }

        return $this->cachedLogicClasses[$attributeKey];
    }

    /**
     * Returns the logic class from the logic factory
     *
     * @param string|null $attribute    the used attribute from the model to use as a class. When null, the default
     * property will be used. Enables multiple logic usage in model.
     *
     * @return mixed
     */
    public function getLogicInstance($attribute = null)
    {
        return $this->getLogicFactory($attribute)->getLogic();
    }

    /**
     * Detects if we should use the default attribute name or provided.
     *
     * @param string|null $attribute    the used attribute from the model to use as a class. When null, the default
     * property will be used. Enables multiple logic usage in model.
     *
     * @return string
     */
    protected function getLogicAttributeName($attribute = null)
    {
        if (!is_null($attribute)) {
            return $attribute;
        }

        return $this->logicAttributeName;
    }

    /**
     * Creates a logic factory based on attribute name. This will create
     * the correct logic factory based on attribute name (if you support multiple usage)
     * in the model
     *
     * @param string|null $classValue
     * @param string $attributeName
     * @return LogicFactory
     */
    abstract public function createLogicFactory($classValue, $attributeName);

    /**
     * Returns current cached logic classes
     * @return array
     */
    public function getCachedLogicClasses()
    {
        return $this->cachedLogicClasses;
    }
}