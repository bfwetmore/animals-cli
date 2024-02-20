<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use src\Animals\CreatureInterface;
use src\CommandLineHandler;

class CommandLineHandlerTest extends TestCase
{
    public function testValidateUserArgumentsWithMultipleAnimals(): void
    {
        $clh = new CommandLineHandler();
        $reflection = new ReflectionClass($clh);
        $method = $reflection->getMethod('validateUserArguments');
        $method->setAccessible(true);

        $userArguments = ["script_name", "Pancho", "cat", "Rex", "dog"];

        $this->expectNotToPerformAssertions();

        $method->invokeArgs($clh, [$userArguments]);
    }

    public function testValidateUserArgumentsWithOddAmountOfArgs(): void
    {
        $clh = new CommandLineHandler();
        $reflection = new ReflectionClass($clh);
        $method = $reflection->getMethod('validateUserArguments');
        $method->setAccessible(true);

        $userArguments = ["script_name", "Pancho", "cat", "Rex"];

        $this->expectExceptionMessage("Odd number of arguments. For multiple word names or animal types, please include double quotes. Ex:[\"Snow Leopard\"]");

        $method->invokeArgs($clh, [$userArguments]);
    }

    public function testValidateUserArgumentsWithNotEnoughArgs(): void
    {
        $clh = new CommandLineHandler();
        $reflection = new ReflectionClass($clh);
        $method = $reflection->getMethod('validateUserArguments');
        $method->setAccessible(true);

        $userArguments = ["script_name", "Pancho"];

        $this->expectExceptionMessage("Insufficient number of arguments provided. Please at least one pair of name and an animal type.");
        $this->expectException(\InvalidArgumentException::class);

        $method->invokeArgs($clh, [$userArguments]);
    }

    public function testGetOrganizedArrayOfAnimalsWithOddAmountOfArgs()
    {
        $clh = new CommandLineHandler();
        $reflection = new ReflectionClass($clh);
        $method = $reflection->getMethod('getOrganizedArrayOfAnimals');
        $method->setAccessible(true);

        $args = ['path', 'archie', 'dog', 'sam', 'cat'];
        $result = $method->invokeArgs($clh, [$args]);

        $expectedResult = ['name' => 'Sam', 'type' => 'cat'];
        $this->assertEquals($expectedResult, $result[1]);
    }

    public function testbuildUserMessages()
    {
        $clh = new CommandLineHandler();
        $reflection = new ReflectionClass($clh);
        $method = $reflection->getMethod('buildUserMessages');
        $method->setAccessible(true);

        $arrayOfAnimals = [
            ["name" => "Boon", "type" => "Cow"],
            ["name" => "Sammy", "type" => "Dog"]
        ];

        $result = $method->invoke($clh, $arrayOfAnimals);

        $expected = ["Boon says \"moo\"\n", "Sammy says \"woof\"\n"];

        $this->assertCount(2, $result);
        $this->assertEquals($expected, $result);
    }

    public function testBuildAnimalObject()
    {
        $clhMock = $this->getMockBuilder(CommandLineHandler::class)
            ->onlyMethods(['initiateCustomAnimalPrompt']) // Specify the method to mock
            ->getMock();

        $clhMock->expects($this->once())
            ->method('initiateCustomAnimalPrompt')
            ->willReturn('CustomSound');

        $reflection = new ReflectionClass($clhMock);
        $method = $reflection->getMethod('buildAnimalObject');
        $method->setAccessible(true);

        $animalData = ['name' => 'Rajah', 'type' => 'Tiger'];

        $result = $method->invoke($clhMock, $animalData);

        $this->assertInstanceOf(CreatureInterface::class, $result);
    }

    public function testInitiateCustomAnimalPrompt()
    {
        $clhMock = $this->getMockBuilder(CommandLineHandler::class)
            ->onlyMethods(['getUserInput']) // Specify the method to mock
            ->getMock();

        $clhMock->expects($this->once())
            ->method('getUserInput')
            ->willReturn('Ring Ding');

        $reflection = new ReflectionClass($clhMock);
        $method = $reflection->getMethod('initiateCustomAnimalPrompt');
        $method->setAccessible(true);
        $name = "Eddie";
        $type = "fox";

        $result = $method->invokeArgs($clhMock, [$name, $type]);

        $expected = "Ring Ding";

        $this->assertEquals($expected, $result);
    }
}
