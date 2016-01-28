<?php
namespace Pion\Support\Logic;

use Illuminate\Support\Collection;
use Prophecy\Exception\Doubler\ClassNotFoundException;

/**
 * Class LogicFactory
 *
 * You must provide your own $list keyword in your class
 *
 * @package Pion\Support\Logic
 */
abstract class LogicFactory
{

    /**
     * The logic name used for creating the logic class
     * @var string
     */
    private $logicClass;

    /**
     * Current logic object
     * @var
     */
    private $logic;

    /**
     * LogicFactory constructor.
     * @param string $logicClass
     */
    public function __construct($logicClass)
    {
        $this->logicClass = $logicClass;
    }

    #######
    ### Static methods
    #######

    /**
     * Returns a collection of indexed logic classes with name
     * @return Collection
     */
    public static function lists()
    {
        if (is_null(static::$list)) {
            // run the static method to enable overiding
            // and save the list to the correct class
            static::$list = static::createLogicList();
        }

        return static::$list;
    }

    /**
     * Returns a list of classes (keys of the lists)
     * @return array
     */
    public static function keys()
    {
        return array_keys(static::lists()->toArray());
    }

    /**
     * Checks if given logic class is vlaide
     * @param string $logicClass
     * @return bool
     */
    public static function valide($logicClass)
    {
        $factory = new static($logicClass);
        return $factory->isValide();
    }

    /**
     * Returns the title for the given logic class
     * @param $logicClass
     * @return string|null
     */
    public static function title($logicClass)
    {
        $factory = new static($logicClass);
        return $factory->getTitle();
    }

    #######
    ### Static Abstract methods
    #######

    /**
     * Returns a collection of indexed logic classes with name. This
     * value is cached
     * @return Collection
     */
    static function createLogicList() {
        return null;
    }

    /**
     * A namespace where the logic classes are stored. Like
     * __NAMESPACE__."\\Types
     * @return string
     */
    static function logicNamespace() {
        return __NAMESPACE__;
    }

    #######
    ### Basic methods
    #######

    /**
     * Creates the logic instance
     * @return mixed
     * @throws ClassNotFoundException
     */
    protected function createLogicInstance()
    {

        // create the namespace
        $class = static::logicNamespace() . "\\" . $this->createLogicClassName();

        if (!class_exists($class)) {
            throw new ClassNotFoundException("Class not found", $class);
        }

        // create new class
        return new $class($this);
    }

    /**
     * Enables changing the logicClass to be different string
     * @return string
     */
    protected function createLogicClassName() {
        return $this->logicClass;
    }

    /**
     * Creates the logic for current type if needed
     * @return mixed
     * @throws ClassNotFoundException
     */
    public function getLogic()
    {
        if (is_null($this->logic)) {
            $this->logic = $this->createLogicInstance();
        }
        return $this->logic;
    }

    /**
     * Returns the current logic class
     * @return string
     */
    public function getLogicClass()
    {
        return $this->logicClass;
    }

    /**
     * Checks if the current logic class is valide
     * @return bool
     */
    public function isValide()
    {
        return static::lists()->offsetExists($this->logicClass);
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return static::lists()->get($this->logicClass);
    }
}