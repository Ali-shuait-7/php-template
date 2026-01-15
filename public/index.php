<?php

$container = require __DIR__ . "/../bootstrap/app.php";

// 1. Get the Connection instance
$pdo = $container->get(PDO::class);
// 3. Now you can run your query

$stmt = $pdo->query("SELECT 1 + 3 as result");

var_dump($stmt->fetch(\PDO::FETCH_ASSOC));