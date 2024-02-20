<?php

$arguments = $argv;

require __DIR__ . '/vendor/autoload.php';

use src\CommandLineHandler;

$cli = new CommandLineHandler();

try {
    $cli->run($arguments);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
