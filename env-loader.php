<?php
if (!file_exists(__DIR__.'/.env')) {
    throw new RuntimeException('No se encontró el archivo .env');
}

$lines = file(__DIR__.'/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    
    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);
    
    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
        putenv("$name=$value");
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}