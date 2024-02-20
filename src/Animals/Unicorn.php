<?php

namespace src\Animals;

class Unicorn extends MythicalCreature
{
    public function __construct(string $name)
    {
        parent::__construct($name, "Unicorns are too fabulous for labels and words");
    }
}