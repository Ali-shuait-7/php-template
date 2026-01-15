<?php

namespace App\database;

use PDO,PDOException;
use RuntimeException;

class Connection
{
    public function __construct(private array $config)
    {
    }

    public function connect(): PDO
    {

        $dsn = \sprintf(

            "%s:host=%s;dbname=%s;port=%d;charset=%s",

            $this->config["driver"] ?? "mysql",

            $this->config["host"] ?? "localhost",

            $this->config["name"],

            $this->config["port"] ?? 3306,

            $this->config["charset"] ?? "utf8mb4"

        );

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {

            return new PDO(
                $dsn,
                $this->config["user"],
                $this->config["password"],
                $options
            );

        } catch (PDOException $e) {

            throw new RuntimeException("Could not connect to database: " . $e->getMessage());
        }

    }

}