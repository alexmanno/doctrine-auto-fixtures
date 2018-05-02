<?php

namespace AlexManno\Tests;

use AlexManno\Engine\FixtureEngine;
use AlexManno\Tests\Entities\AnotherEntity;
use AlexManno\Tests\Entities\Entity;
use AlexManno\Tests\Factories\SurnameFactory;
use PHPUnit\Framework\TestCase;

class FixtureEngineTest extends TestCase
{
    /**
     * @throws \AlexManno\Exceptions\AnnotationException
     */
    public function testGetEntity()
    {
        $engine = new FixtureEngine();
        /** @var Entity $fixture */
        $fixture = $engine->get(Entity::class);

        $this->assertInstanceOf(Entity::class, $fixture);
        $this->assertEquals('Alessandro', $fixture->getName());
        $this->assertTrue(\in_array($fixture->getSurname(), SurnameFactory::SURNAMES));
    }

    /**
     * @throws \AlexManno\Exceptions\AnnotationException
     */
    public function testGetAnotherEntity()
    {
        $engine = new FixtureEngine();
        /** @var AnotherEntity $fixture */
        $fixture = $engine->get(AnotherEntity::class);

        $this->assertInstanceOf(AnotherEntity::class, $fixture);
        $this->assertEquals('Filippo', $fixture->getName());
    }

    /**
     * @throws \AlexManno\Exceptions\AnnotationException
     */
    public function testGetAnotherEntityIt()
    {
        $engine = new FixtureEngine();
        /** @var AnotherEntity $fixture */
        $fixture = $engine->get(AnotherEntity::class);

        $this->assertInstanceOf(AnotherEntity::class, $fixture);
        $this->assertInstanceOf(Entity::class, $fixture->getEntity());

        $this->assertEquals('Filippo', $fixture->getName());
        $this->assertEquals('Alessandro', $fixture->getEntity()->getName());
        $this->assertTrue(\in_array($fixture->getEntity()->getSurname(), SurnameFactory::SURNAMES));
    }
}
