<?php

declare(strict_types=1);

namespace AlexManno\Tests\Factories;

class SurnameFactory
{
    public const SURNAMES = [
        'Manno',
        'Pastori',
        'Villa',
    ];

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return self::SURNAMES[\array_rand(self::SURNAMES, 1)];
    }
}
