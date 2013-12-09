<?php namespace League\Fractal\Test;

use League\Fractal;

class ResourceManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers League\Fractal\ResourceManager::setRequestedScopes
     */
    public function testSetRequestedScopes()
    {
        $manager = new Fractal\ResourceManager();
        $foo = $manager->setRequestedScopes(['foo', 'bar', 'baz.bart']);
        $this->assertInstanceOf('League\Fractal\ResourceManager', $foo);
    }

    /**
     * @covers League\Fractal\ResourceManager::getRequestedScopes
     */
    public function testGetRequestedScopes()
    {
        $manager = new Fractal\ResourceManager();
        $manager->setRequestedScopes(['foo', 'bar', 'baz.bart']);
        $this->assertEquals($manager->getRequestedScopes(), ['foo', 'bar', 'baz.bart']);
    }

    /**
     * @covers League\Fractal\ResourceManager::createData
     */
    public function testCreateData()
    {
        $manager = new Fractal\ResourceManager();

        $resource = new Fractal\ItemResource(['foo' => 'bar'], function (array $data) {
            return $data;
        });

        $rootScope = $manager->createData($resource);
        
        $this->assertInstanceOf('League\Fractal\Scope', $rootScope);
        $this->assertEquals($rootScope->toArray(), ['foo' => 'bar']);
    }
}
