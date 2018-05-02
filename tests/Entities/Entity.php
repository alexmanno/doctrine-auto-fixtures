<?php

declare(strict_types=1);

namespace AlexManno\Tests\Entities;

use AlexManno\Annotations\Fixture;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity")
 * @ORM\Entity
 */
class Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @Fixture(value="Alessandro")
     */
    private $name;
    /**
     * @var string
     *
     * @Fixture(factory="AlexManno\Tests\Factories\SurnameFactory:getSurname")
     */
    private $surname;

    /**
     * @var string
     *
     * @Fixture(faker="address")
     */
    private $address;

    /**
     * @var AnotherEntity
     *
     * @Fixture(class="AlexManno\Tests\Entities\AnotherEntity")
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
     * @return Entity
     */
    public function setId(int $id): Entity
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
     * @return Entity
     */
    public function setName(string $name): Entity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Entity
     */
    public function setSurname(string $surname): Entity
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Entity
     */
    public function setAddress(string $address): Entity
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return AnotherEntity
     */
    public function getEntity(): AnotherEntity
    {
        return $this->entity;
    }

    /**
     * @param AnotherEntity $entity
     * @return Entity
     */
    public function setEntity(AnotherEntity $entity): Entity
    {
        $this->entity = $entity;

        return $this;
    }
}
