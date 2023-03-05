<?php

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=yii',
    'username' => 'yii',
    'password' => 'yii-mysql-password',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

if (file_exists(__DIR__ . '/db-production.php')) {
    $db = array_merge($db, require __DIR__ . '/db-production.php');
}

return $db;
