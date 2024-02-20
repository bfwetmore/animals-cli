<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Animals\MythicalCreature;

class MythicalCreatureTest extends TestCase
{
    public function testConstructorAndGetters()
    {
        $creature = new MythicalCreature('Dragon', 'Roar');

        $this->assertSame('Roar', $creature->getSound());
    }

    public function testMessage()
    {
        $creature = new MythicalCreature('Phoenix', 'Caw');

        $expectedMessage = 'Caw' . PHP_EOL;
        $this->assertSame($expectedMessage, $creature->message());
    }

    public function testSetSound()
    {
        $creature = new MythicalCreature('Fox', 'Ring Ding Ding Ding');

        $creature->setSound('Haw paw paw paw paw');

        $this->assertSame('Haw paw paw paw paw', $creature->getSound());
    }
}
