<?php
namespace Tests\Mock\Models;

use Pion\Support\Logic\Traits\ModelSingleLogicTrait;
use Tests\Mock\TypeFactory;

/**
 * Class ModelSingleLogic
 *
 * An example of simple model with single logic attribute representing the class.
 *
 * In this example there is no overide of the default attribute name.
 *
 * @package Test\Mock\Models
 */
class ModelSingleLogic
{
    use ModelSingleLogicTrait;

    /**
     * Must provide the test type
     * @var string
     */
    protected $logic = "TestType";

    /**
     * Returns the action factory class name
     * @return string
     */
    public function getLogicFactoryClass()
    {
        return TypeFactory::class;
    }

}