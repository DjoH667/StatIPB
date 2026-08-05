<?php

$AppConfig = include __DIR__ . '/config.php';

if (isset($AppConfig['timezone'])) {
    date_default_timezone_set($AppConfig['timezone']);
}

class MyDB extends SQLite3
{
    function __construct()
    {
        global $AppConfig;

        if (!file_exists($AppConfig['database_path'])) {
            throw new Exception("Base SQLite introuvable: ".$AppConfig['database_path']);
        }

        $this->open($AppConfig['database_path']);
    }
}

try {
    $bd = new MyDB();
} catch (Exception $e) {
    die("La creation ou l'ouverture de la base a echouee pour la raison suivante: ".$e->getMessage());
}

?>
