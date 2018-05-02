<?php

declare(strict_types=1);

namespace AlexManno\Annotations;

use Doctrine\ORM\Mapping\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Fixture implements Annotation
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $factory;

    /**
     * @var string
     */
    public $class;
}
