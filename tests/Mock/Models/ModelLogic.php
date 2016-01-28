<?php
namespace Tests\Mock\Models;

use Pion\Support\Logic\Traits\ModelLogicTrait;
use Tests\Mock\ActionFactory;
use Tests\Mock\TypeFactory;

/**
 * Class ModelLogic
 *
 * Acts as a base eloquent model. Only for testing.
 *
 * @package Test\Mock\Models
 */
class ModelLogic
{
    use ModelLogicTrait;

    /**
     * Used for testing without of duplication of code. Defines the attribute name.
     */
    const ACTION_ATTRIBUTE = "action";

    /**
     * Used for testing without of duplication of code. Defines the attribute name.
     */
    const TYPE_ATTRIBUTE = "type";

    /**
     * Act ass a attribute in model
     * @var string
     */
    protected $type = "TestType";

    /**
     * Act ass a attribute in model
     * @var string
     */
    protected $action = "TestAction";

    /**
     * ModelLogic constructor.
     */
    public function __construct()
    {
        // example of overide the default attribute name to custom. Optional.
        $this->logicAttributeName = self::TYPE_ATTRIBUTE;
    }


    /**
     * Creates the logic factory based on attribute name
     * @param $classValue
     * @param $attributeName
     * @return null|ActionFactory|TypeFactory
     */
    public function createLogicFactory($classValue, $attributeName)
    {
        switch ($attributeName) {
            case self::TYPE_ATTRIBUTE:
                return new TypeFactory($classValue);
                break;
            case self::ACTION_ATTRIBUTE:
                return new ActionFactory($classValue);
                break;
            default:
                return null;
        }
    }


}