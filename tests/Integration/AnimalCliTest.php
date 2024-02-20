<?php

namespace Integration;

use PHPUnit\Framework\TestCase;
use src\CommandLineHandler;

class AnimalCliTest extends TestCase
{
    public function testRunWithCatAndDog()
    {
        $userArguments = ['path', 'Fluffy', 'Cat', 'Buddy', 'Dog'];

        $clh = new CommandLineHandler();

        ob_start();
        $clh->run($userArguments);
        $output = ob_get_clean();

        $expectedOutput = "Fluffy says \"meow\"" . PHP_EOL . "Buddy says \"woof\"" . PHP_EOL;
        $this->assertSame($expectedOutput, $output);
    }

    public function testRunWithHorseAndBird()
    {
        $userArguments = ['path', 'Betsy', 'cow'];

        $clh = new CommandLineHandler();

        ob_start();
        $clh->run($userArguments);
        $output = ob_get_clean();

        $expectedOutput = "Betsy says \"moo\"" . PHP_EOL;
        $this->assertSame($expectedOutput, $output);
    }
}
