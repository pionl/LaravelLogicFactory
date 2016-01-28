<?php
namespace Test;

use Tests\Mock\Models\ModelSingleLogic;
use Tests\Mock\BaseTraitTests;

class ModelSingleLogicTraitTest extends \PHPUnit_Framework_TestCase
{
    use BaseTraitTests;

    protected function setUp()
    {
        parent::setUp();
        $this->modelLogic = new ModelSingleLogic();
    }

}
