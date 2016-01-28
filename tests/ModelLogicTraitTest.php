<?php
namespace Tests;

use Tests\Mock\ActionFactory;
use Tests\Mock\Actions\TestAction;
use Tests\Mock\BaseTraitTests;
use Tests\Mock\Models\ModelLogic;

class ModelLogicTraitTest extends \PHPUnit_Framework_TestCase
{
    use BaseTraitTests;

    protected function setUp()
    {
        parent::setUp();

        $this->modelLogic = new ModelLogic();
    }

    public function testGetLogicFactoryAction()
    {
        // uses the default value
        $factory = $this->modelLogic->getLogicFactory(ModelLogic::ACTION_ATTRIBUTE);
        $this->assertNotNull($factory);
        $this->assertInstanceOf(ActionFactory::class, $factory);
    }

    public function testGetLogicInstanceAction()
    {
        $this->assertInstanceOf(TestAction::class,
            $this->modelLogic->getLogicInstance(ModelLogic::ACTION_ATTRIBUTE));
    }
}
