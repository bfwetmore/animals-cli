<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Animals\Animal;

class AnimalTest extends TestCase
{
    public function testConstructorAndGetters()
    {
        $animal = new Animal('Fluffy', 'meow');

        $this->assertSame('meow', $animal->getSound());
    }

    public function testMessage()
    {
        $animal = new Animal('Fluffy', 'meow');

        $expectedMessage = 'Fluffy says "meow"' . PHP_EOL;
        $this->assertSame($expectedMessage, $animal->Message());
    }

    public function testSetSound()
    {
        $animal = new Animal('Fluffy', 'meow');

        $animal->setSound('Purr');

        $this->assertSame('Purr', $animal->getSound());
    }
}
