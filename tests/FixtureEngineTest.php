<?php

namespace AlexManno\Tests;

use AlexManno\Engine\FixtureEngine;
use AlexManno\Tests\Entities\AnotherEntity;
use AlexManno\Tests\Entities\Entity;
use AlexManno\Tests\Factories\SurnameFactory;
use Faker\Generator;
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
    public function testGetEntityFaker()
    {
        $generator = new class() extends Generator {
            public function __get($attribute)
            {
                if ('address' === $attribute) {
                    return 'Address 42';
                }

                return parent::__get($attribute);
            }
        };

        $engine = new FixtureEngine($generator);
        /** @var Entity $fixture */
        $fixture = $engine->get(Entity::class);

        $this->assertInstanceOf(Entity::class, $fixture);
        $this->assertEquals('Address 42', $fixture->getAddress());
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

    /**
     * @throws \AlexManno\Exceptions\AnnotationException
     */
    public function testGetEntityIt()
    {
        $engine = new FixtureEngine();
        /** @var Entity $fixture */
        $fixture = $engine->get(Entity::class);

        $this->assertInstanceOf(Entity::class, $fixture);
        $this->assertInstanceOf(AnotherEntity::class, $fixture->getEntity());

        $this->assertEquals('Filippo', $fixture->getEntity()->getName());
    }

    /**
     * @throws \AlexManno\Exceptions\AnnotationException
     */
    public function testGetAnotherEntityRecursive()
    {
        $engine = new FixtureEngine();
        /** @var AnotherEntity $fixture */
        $fixture = $engine->get(AnotherEntity::class);

        $this->assertInstanceOf(AnotherEntity::class, $fixture);
        $this->assertInstanceOf(Entity::class, $fixture->getEntity());

        $this->assertEquals('Filippo', $fixture->getName());
        $this->assertEquals(
            'Alessandro',
            $fixture->getEntity()->getEntity()->getEntity()->getEntity()->getEntity()->getName()
        );
        $this->assertTrue(
            \in_array(
                $fixture->getEntity()->getEntity()->getEntity()->getEntity()->getEntity()->getSurname(),
                SurnameFactory::SURNAMES
            )
        );
    }
}
