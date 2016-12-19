<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '33060',
    'dbname'   => 'eminehakan',
    'user'     => 'homestead',
    'password' => 'secret',
);


// enable the debug mode
$app['debug'] = true;
