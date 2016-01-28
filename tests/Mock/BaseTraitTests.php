<?php
namespace Tests\Mock;

use Pion\Support\Logic\Traits\ModelLogicTrait;
use Tests\Mock\Types\TestType;

/**
 * Class BaseTraitTests
 *
 * A set of tests that are same for ModelSingleLogicTrait and ModelLogicTrait
 *
 * @package Tests\Mock
 */
trait BaseTraitTests {

    /**
     * @var ModelLogicTrait
     */
    protected $modelLogic;

    public function testGetLogicFactory()
    {
        // uses the default value
        $factory = $this->modelLogic->getLogicFactory();
        $this->assertNotNull($factory);
        $this->assertInstanceOf(TypeFactory::class, $factory);
    }

    public function testGetLogicFactoryCache()
    {
        $factory = $this->modelLogic->getLogicFactory();
        $factory2 = $this->modelLogic->getLogicFactory();
        $this->assertEquals($factory, $factory2);
        $this->assertCount(1, $this->modelLogic->getCachedLogicClasses());
    }

    public function testGetLogicInstance()
    {
        $this->assertInstanceOf(TestType::class,
            $this->modelLogic->getLogicInstance());
    }

}