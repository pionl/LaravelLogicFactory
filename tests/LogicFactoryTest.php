<?php
namespace Tests;

use Prophecy\Exception\Doubler\ClassNotFoundException;
use Tests\Mock\AbstractFactory;
use Tests\Mock\TypeFactory;
use Tests\Mock\Types\TestType;

class LogicFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TypeFactory
     */
    protected $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new TypeFactory(TypeFactory::TYPE_TEST);
    }

    public function testCreate()
    {
        $this->assertNotNull($this->factory->getLogicClass());
    }

    public function testIsValide()
    {
        $this->assertTrue($this->factory->isValide(), "The string(constant) must be in created list");
    }

    public function testIsValideWithInvalide()
    {
        $this->factory = new TypeFactory("unknown");
        $this->assertFalse($this->factory->isValide(), "The string(constant) must be in created list");
    }

    /**
     * Test sucessfull logic instance creation
     */
    public function testGetLogic()
    {
        $this->assertInstanceOf(TestType::class, $this->factory->getLogic());
    }

    /**
     * Tests the invalide class
     */
    public function testGetInvalideLogic()
    {
        try {
            $this->factory = new TypeFactory("unknown");
            $this->assertInstanceOf(TestType::class, $this->factory->getLogic());
            $this->fail("The class should not be found");
        } catch (ClassNotFoundException $ex) {
            // the class was notfound which is correct
        }
    }

    public function testGetTitle()
    {
        $this->assertEquals(TypeFactory::TYPE_TEST_TITLE, $this->factory->getTitle());
    }

    public function testGetTitleInvalide()
    {
        $this->factory = new TypeFactory(null);
        $this->assertNull($this->factory->getTitle());
    }

    public function testTitle()
    {
        $this->assertEquals(TypeFactory::TYPE_TEST_TITLE, TypeFactory::title(TypeFactory::TYPE_TEST));
    }

    /**
     * Tests the static isValide
     */
    public function testValide()
    {
        $this->assertTrue(TypeFactory::valide(TypeFactory::TYPE_TEST));
    }

    /**
     * Returns the supported logic lists
     */
    public function testLists()
    {
        $list = TypeFactory::lists();
        $this->assertArrayHasKey(TypeFactory::TYPE_TEST, $list);
    }

    /**
     * Check if keys are returned from the logic list
     */
    public function testKey()
    {
        $list = TypeFactory::keys();
        $this->assertTrue(in_array(TypeFactory::TYPE_TEST, $list));
    }

    /**
     * Check if the overide is working
     */
    public function testLogicNamespace()
    {
        $this->assertEquals("Tests\\Mock\\Types", TypeFactory::logicNamespace(),
            "The namespace must be correct to the namespace of class. Defines locaiton of
            logic classes");
    }

    /**
     * Check if the cache is working
     */
    public function testSameInstance()
    {
        $logic = $this->factory->getLogic();
        $this->assertEquals($logic, $this->factory->getLogic());
    }

    /**
     * Test method that are usally overided.
     */
    public function testParentLogicNamespace()
    {
        $this->assertEquals("Pion\Support\Logic", AbstractFactory::logicNamespace());
    }

    /**
     * Test method that are usally overided.
     */
    public function testParentCreateLogicList()
    {
        $this->assertNull(AbstractFactory::createLogicList());
    }
}
