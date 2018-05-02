# doctrine-auto-fixtures
Automatic fixture for doctrine entities

[![Build Status](https://travis-ci.org/alexmanno/doctrine-auto-fixtures.svg?branch=master)](https://travis-ci.org/alexmanno/doctrine-auto-fixtures)
![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/alexmanno/doctrine-auto-fixtures.svg)

## Installation

```bash
composer require alexmanno/doctrine-auto-fixtures
```

## Usage

In your entity:

##### Fixed value on field
```php
class Entity {
    /**
     * @Fixture(value="Fixed value")
     */
    private $entityField;
}
```

##### Factory on field
```php
class Entity {
    /**
     * @Fixture(factory="Acme\FactoryClass:factoryMethod")
     */
    private $entityField;
}
```

##### Link another entity on field
```php
class Entity {
    /**
     * @Fixture(class="Acme\AnotherEntity")
     */
    private $entityField;
}
```

Than in your tests:

```php
    // ----
    $engine = new AlexManno\Engine\FixtureEngine();
    $fixture = $engine->get(Acme\Entity::class); // <- this will return your fixture
    // ----
```