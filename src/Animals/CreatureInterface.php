<?php

namespace src\Animals;

interface CreatureInterface
{
    public function Message(): string;

    public function getSound(): string;

    public function setSound(string $sound): void;
}
