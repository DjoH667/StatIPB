<?php

$DefaultDatabasePath = __DIR__ . '/iPassBall.V.0.26.db';

if (!file_exists($DefaultDatabasePath)) {
    $DefaultDatabasePath = __DIR__ . '/iPassBall.V.0.22.db';
}

$ConfiguredDatabasePath = getenv('STATIPB_DATABASE');

return [
    'database_path' => $ConfiguredDatabasePath ? $ConfiguredDatabasePath : $DefaultDatabasePath,
    'timezone' => 'Europe/Paris',
];
