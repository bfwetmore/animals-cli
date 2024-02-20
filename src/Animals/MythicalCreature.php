<?php

namespace src\Animals;

class MythicalCreature implements CreatureInterface
{
    protected string $name;
    protected string $sound;

    public function __construct(string $name, string $sound)
    {
        $this->name = $name;
        $this->sound = $sound;
    }

    public function message(): string
    {
        return $this->sound . PHP_EOL;
    }

    public function getSound(): string
    {
        return $this->sound;
    }

    public function setSound(string $sound): void
    {
        $this->sound = $sound;
    }
}
