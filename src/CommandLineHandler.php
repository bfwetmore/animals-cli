<?php

namespace src;

use InvalidArgumentException;
use src\Animals\CreatureInterface;
use src\Factory\AnimalBuilder;

class CommandLineHandler
{
    public function run(array $userArguments): void
    {
        $this->validateUserArguments($userArguments);
        $arrayOfAnimals = $this->getOrganizedArrayOfAnimals($userArguments);
        $arrayOfMessages = $this->buildUserMessages($arrayOfAnimals);
        foreach ($arrayOfMessages as $message) {
            echo $message;
        }
    }

    /**
     * Validates the user-provided command line arguments.
     *
     * @param array $argv The array of command line arguments.
     *
     * @throws InvalidArgumentException If the number of arguments is insufficient or odd.
     */
    protected function validateUserArguments(array $argv): void
    {
        if (count($argv) < 3) {
            throw new InvalidArgumentException("Insufficient number of arguments provided. Please at least one pair of name and an animal type.");
        }
        //First Value of the array is users path
        if ((count($argv) - 1) % 2 === 1) {
            throw new InvalidArgumentException("Odd number of arguments. For multiple word names or animal types, please include double quotes. Ex:[\"Snow Leopard\"]");
        }
    }

    /**
     * Organizes the array of command line arguments into an array of animal data.
     *
     * Each pair of elements in the input array represents a name and its corresponding type.
     * The method extracts name and type pairs from the input array and organizes them into
     * associative arrays where 'name' is the key for the animal's name and 'type' is the key
     * for the animal's type.
     *
     * @param array $args The array of command line arguments containing pairs of name and type.
     *
     * @return array An array of associative arrays representing each animal's data.
     */
    protected function getOrganizedArrayOfAnimals(array $args): array
    {
        array_shift($args);

        $organizedAnimals = [];

        for ($i = 0; $i < count($args); $i += 2) {
            $name = ucfirst($args[$i]);
            $type = $args[$i + 1];

            $animalData = [
                'name' => $name,
                'type' => $type
            ];
            $organizedAnimals[] = $animalData;
        }
        return $organizedAnimals;
    }

    /**
     * Builds user messages for each animal in the provided array.
     *
     * @param array $arrayOfAnimals An array containing data for each animal.
     *
     * @return array An array of strings representing messages for each animal.
     */
    protected function buildUserMessages(array $arrayOfAnimals): array
    {
        $messageArray = [];
        foreach ($arrayOfAnimals as $animal) {
            $animalObject = $this->buildAnimalObject($animal);
            $messageArray[] = $this->getMessageForAnimal($animalObject);
        }
        return $messageArray;
    }

    /**
     * Builds an Animal object based on the provided data and handles custom sounds if needed.
     *
     * @param array $animalData An array containing data for the animal.
     *
     * @return CreatureInterface An instance of the Animal class representing the animal.
     */
    protected function buildAnimalObject(array $animalData): CreatureInterface
    {
        $name = $animalData["name"];
        $type = $animalData["type"];
        $animalObject = AnimalBuilder::buildAnimal($name, $type);
        if ($animalObject->getSound() === "") {
            $customSound = $this->initiateCustomAnimalPrompt($name, $type);
            $animalObject->setSound($customSound);
        }
        return $animalObject;
    }

    /**
     * Retrieves the message for the provided animal.
     *
     * @param CreatureInterface $animal The animal object for which to retrieve the message.
     *
     * @return string The message for the provided animal.
     */
    protected function getMessageForAnimal(CreatureInterface $animal): string
    {
        return $animal->Message();
    }

    /**
     * Initiates a prompt to customize the sound of a new animal type.
     *
     * @param string $name The name of the new animal.
     * @param string $type The type of the new animal.
     *
     * @return string The custom sound specified by the user, or an empty string if not provided.
     */
    protected function initiateCustomAnimalPrompt(string $name, string $type): string
    {
        echo "$name the $type is a new animal type. What cool thing does $name the $type say?" . PHP_EOL;
        $customSound = $this->getUserInput();
        return $customSound ? rtrim($customSound, "\n") : "";
    }

    protected function getUserInput(): false|string
    {
        return fgets(STDIN);
    }
}
