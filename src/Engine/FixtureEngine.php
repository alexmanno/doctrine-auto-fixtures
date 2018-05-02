<?php

declare(strict_types=1);

namespace AlexManno\Engine;

use AlexManno\Annotations\Fixture;
use AlexManno\Exceptions\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class FixtureEngine
{
    /** @var array */
    private $loadedClass = [];

    /**
     * @param string $fqcn
     * @return object
     * @throws AnnotationException
     */
    public function get(string $fqcn)
    {
        if (isset($this->loadedClass[$fqcn])) {
            return $this->loadedClass[$fqcn];
        }

        try {
            AnnotationRegistry::registerLoader([require __DIR__ . '/../../vendor/autoload.php', 'loadClass']);
            $reader = new AnnotationReader();
            $properties = (new \ReflectionClass($fqcn))->getProperties();
            $fixture = new $fqcn();

            foreach ($properties as $property) {
                /** @var Fixture|null $annotation */
                $annotation = $reader->getPropertyAnnotation($property, Fixture::class);
                if (null === $annotation) {
                    continue;
                }

                $this->setProperty($fixture, $property, $annotation);
            }

            $this->loadedClass[$fqcn] = $fixture;

            return $fixture;
        } catch (\Throwable $exception) {
            throw new AnnotationException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param object $fixture
     * @param \ReflectionProperty $property
     * @param Fixture $annotation
     * @throws AnnotationException
     */
    private function setProperty($fixture, \ReflectionProperty $property, $annotation)
    {
        $property->setAccessible(true);

        if ($annotation->value) {
            $property->setValue($fixture, $annotation->value);
        }

        if ($annotation->factory) {
            $factoryParts = \explode(':', $annotation->factory);
            $factoryClass = $factoryParts[0];
            $factoryMethod = $factoryParts[1];

            $property->setValue($fixture, \call_user_func([new $factoryClass, $factoryMethod]));
        }

        if ($annotation->class) {
            $property->setValue($fixture, $this->get($annotation->class));
        }

        $property->setAccessible(false);
    }
}
