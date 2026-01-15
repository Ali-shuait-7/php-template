<?php
/**
 * --------------------------------------------------------------------------
 * Dependency Injection Container Configuration
 * --------------------------------------------------------------------------
 * 1. ContainerBuilder: The factory responsible for building the final container.
 * 2. get(): Used to reference an existing entry or alias in the container.
 * 3. autowire(): Smart tool that automatically discovers class dependencies.
 */

use DI\ContainerBuilder;
use function DI\get;
use function DI\autowire;

// implementations
use App\database\Connection;

require __DIR__ . "/../vendor/autoload.php";

// create container-builder

$containerBuilder = new ContainerBuilder();

// add definitions
$containerBuilder->addDefinitions([

    "db_config" => require __DIR__ . "/../config/database.php",

    "app_config" => require __DIR__ . "/../config/settings.php",

        // inject the db_config array (dependency) inside Connection.constructor method (constructor)
    Connection::class => autowire()->constructor(get("db_config")),

    \PDO::class => function ($c): PDO {
        return $c->get(Connection::class)->connect();
    }

]);

$container = $containerBuilder->build();

return $container;