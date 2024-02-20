<?php

namespace src\Factory;

use src\Animals\Animal;
use src\Animals\CreatureInterface;
use src\Animals\Dog;
use src\Animals\Cat;
use src\Animals\Cow;
use src\Animals\Unicorn;

class AnimalBuilder
{
    /**
     * Builds an animal based on the provided name and type.
     *
     * @param string $name The name of the animal.
     * @param string $type The type of the animal.
     *
     * @return CreatureInterface An instance of the built animal, implementing the CreatureInterface.
     */
    public static function buildAnimal(string $name, string $type): CreatureInterface
    {
        return match (strtolower($type)) {
            'cat' => new Cat($name),
            'dog' => new Dog($name),
            'cow' => new Cow($name),
            'unicorn' => new Unicorn($name),
            default => new Animal($name, ""),
        };
    }
}
