<?php

declare(strict_types=1);

namespace AlexManno\Tests\Entities;

use AlexManno\Annotations\Fixture;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="another_entity")
 * @ORM\Entity
 */
class AnotherEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @Fixture(value="Filippo")
     */
    private $name;

    /**
     * @var Entity
     *
     * @Fixture(class="AlexManno\Tests\Entities\Entity")
     */
    private $entity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AnotherEntity
     */
    public function setId(int $id): AnotherEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AnotherEntity
     */
    public function setName(string $name): AnotherEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     * @return AnotherEntity
     */
    public function setEntity(Entity $entity): AnotherEntity
    {
        $this->entity = $entity;

        return $this;
    }
}
