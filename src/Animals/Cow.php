<?php

namespace src\Animals;

class Cow extends Animal
{
    public function __construct(string $name)
    {
        parent::__construct($name, "moo");
    }
}
