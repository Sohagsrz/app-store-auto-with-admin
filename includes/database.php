<?php
use Illuminate\Database\Capsule\Manager as Capsule;
global $auth,$pdo;
// if($_ENV['is_db'] !== true) {
//     return;
// }
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' =>  $_ENV['db_host'],
    'database' => $_ENV['db_name'],
    'username' => $_ENV['db_user'],
    'password' => $_ENV['db_pass'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
try {
    $pdo = Capsule::connection()->getPdo();
    $auth = new \Delight\Auth\Auth($pdo);
} catch (\Exception $e) {
    // echo $e->getMessage();
    // exit();
    
}

 