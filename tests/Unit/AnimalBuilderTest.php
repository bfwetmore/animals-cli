<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Animals\Animal;
use src\Animals\Cat;
use src\Animals\Cow;
use src\Animals\Dog;
use src\Animals\Unicorn;
use src\Factory\AnimalBuilder;

class AnimalBuilderTest extends TestCase
{
    public function testBuildAnimal()
    {
        $cat = AnimalBuilder::buildAnimal('Fluffy', 'cat');
        $this->assertInstanceOf(Cat::class, $cat);

        $dog = AnimalBuilder::buildAnimal('Buddy', 'dog');
        $this->assertInstanceOf(Dog::class, $dog);

        $cow = AnimalBuilder::buildAnimal('Mooey', 'cow');
        $this->assertInstanceOf(Cow::class, $cow);

        $unicorn = AnimalBuilder::buildAnimal('Sparkles', 'unicorn');
        $this->assertInstanceOf(Unicorn::class, $unicorn);

        $unknownAnimal = AnimalBuilder::buildAnimal('Unknown', 'unknown');
        $this->assertInstanceOf(Animal::class, $unknownAnimal);
    }
}
