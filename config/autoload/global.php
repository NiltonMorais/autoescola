<?php

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=autoescola;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AdapterDb' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
