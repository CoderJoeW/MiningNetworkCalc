<?php
$engine = 'nginx';

$db_credentials = [
    'main' => [
        'username'  => 'MAIN_DB_USER',
        'password'  => 'MAIN_DB_PASSWORD',
        'host'      => 'MAIN_DB_HOST',
        'db'        => 'MAIN_DB_DATABASE',
    ]
];

require_once __DIR__.'/Application/Classes/auth.php';
require_once __DIR__.'/Application/Classes/welcome.php';
require_once __DIR__.'/Application/Classes/model.php';
require_once __DIR__.'/Application/Classes/database.php';
?>